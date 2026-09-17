(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;
  var config = window.CreativeStudioContact || {};

  function setHidden(node, hidden) {
    if (!node) {
      return;
    }
    node.hidden = hidden;
    node.classList.toggle('hidden', hidden);
  }

  function setFieldError(form, name, message) {
    var field = form.querySelector('[name="' + name + '"]');
    var error = form.querySelector('[data-field-error="' + name + '"]');
    var hasError = Boolean(message);

    if (field) {
      if (hasError) {
        field.setAttribute('aria-invalid', 'true');
        if (error && error.id) {
          field.setAttribute('aria-describedby', error.id);
        }
      } else {
        field.removeAttribute('aria-invalid');
        field.removeAttribute('aria-describedby');
      }
    }

    if (error) {
      error.textContent = message || '';
      setHidden(error, !hasError);
    }
  }

  function clearErrors(form) {
    ['name', 'email', 'company', 'message'].forEach(function (name) {
      setFieldError(form, name, '');
    });
  }

  function start() {
    var form = document.querySelector('.js-contact-form');
    if (!form) {
      return;
    }

    var submit = form.querySelector('.js-contact-submit');
    var errorNode = form.querySelector('.js-contact-error');
    var successNode = form.querySelector('.js-contact-success');
    var loading = false;

    form.addEventListener('submit', function (event) {
      event.preventDefault();
      if (loading || !config.restUrl) {
        return;
      }

      loading = true;
      clearErrors(form);
      setHidden(errorNode, true);
      setHidden(successNode, true);
      if (errorNode) {
        errorNode.textContent = '';
      }
      if (submit) {
        submit.disabled = true;
        submit.textContent = 'SENDING…';
      }

      var payload = {
        name: (form.elements.name && form.elements.name.value) || '',
        email: (form.elements.email && form.elements.email.value) || '',
        company: (form.elements.company && form.elements.company.value) || '',
        message: (form.elements.message && form.elements.message.value) || '',
        _wpnonce: config.nonce || '',
      };

      window
        .fetch(config.restUrl, {
          method: 'POST',
          credentials: 'same-origin',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(payload),
        })
        .then(function (response) {
          return response.json().catch(function () {
            return {};
          }).then(function (body) {
            return { ok: response.ok, status: response.status, body: body };
          });
        })
        .then(function (result) {
          if (!result.ok) {
            var err = new Error((result.body && result.body.error) || 'Something went wrong.');
            err.fields = (result.body && result.body.fields) || {};
            throw err;
          }

          form.reset();
          setHidden(errorNode, true);
          if (successNode) {
            successNode.textContent = 'Thanks — we will be in touch shortly.';
            setHidden(successNode, false);
          }
        })
        .catch(function (err) {
          var fields = err.fields || {};
          Object.keys(fields).forEach(function (name) {
            setFieldError(form, name, fields[name]);
          });
          if (errorNode) {
            errorNode.textContent = err.message || 'Something went wrong.';
            setHidden(errorNode, false);
          }
          setHidden(successNode, true);
        })
        .then(function () {
          loading = false;
          if (submit) {
            submit.disabled = false;
            submit.textContent = 'SEND MESSAGE →';
          }
        });
    });
  }

  CS.contactPage = {
    init: function () {
      CS.initOnce('contactPage', start);
    },
  };
  CS.contactPage.init();
})(window, document);
