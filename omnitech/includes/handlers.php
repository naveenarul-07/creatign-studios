<?php

declare(strict_types=1);

function handle_contact(): void
{
    if (!csrf_valid()) {
        flash('error', 'Your session expired. Please send the message again.');
        redirect('/contact');
    }

    $name = trim((string) ($_POST['name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $message = trim((string) ($_POST['message'] ?? ''));
    $company = trim((string) ($_POST['company'] ?? ''));
    $honeypot = trim((string) ($_POST['website'] ?? ''));

    set_old([
        'name' => $name,
        'email' => $email,
        'company' => $company,
        'message' => $message,
    ]);

    if ($honeypot !== '') {
        clear_old();
        flash('success', 'Thank you. Your message has been received.');
        redirect('/contact');
    }

    $errors = [];
    if ($name === '' || mb_strlen($name) > 120) {
        $errors[] = 'Please enter your name.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 180) {
        $errors[] = 'Please enter a valid email address.';
    }
    if ($message === '' || mb_strlen($message) < 10 || mb_strlen($message) > 5000) {
        $errors[] = 'Please enter a message of at least 10 characters.';
    }
    if (mb_strlen($company) > 160) {
        $errors[] = 'Company name is too long.';
    }

    if ($errors) {
        flash('error', implode(' ', $errors));
        redirect('/contact');
    }

    append_json('contacts.json', [
        'id' => bin2hex(random_bytes(8)),
        'name' => $name,
        'email' => $email,
        'company' => $company,
        'message' => $message,
        'created_at' => gmdate('c'),
        'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
    ]);

    clear_old();
    flash('success', 'Thank you. Your message has been received. An OMNITECH teammate will follow up.');
    redirect('/contact');
}

function handle_apply(): void
{
    $slug = trim((string) ($_POST['job'] ?? ''));
    $job = job_by_slug($slug);
    $back = $job ? '/career/' . $job['slug'] : '/careers';

    if (!$job || !csrf_valid()) {
        flash('error', 'Your session expired. Please submit the application again.');
        redirect($back);
    }

    $name = trim((string) ($_POST['name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $phone = trim((string) ($_POST['phone'] ?? ''));
    set_old(['name' => $name, 'email' => $email, 'phone' => $phone]);

    $errors = [];
    if ($name === '' || mb_strlen($name) > 120) {
        $errors[] = 'Please enter your name.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if ($phone === '' || mb_strlen($phone) > 40) {
        $errors[] = 'Please enter a phone number.';
    }

    $file = $_FILES['resume'] ?? null;
    $savedName = '';
    if (!is_array($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        $errors[] = 'Please attach a resume.';
    } elseif (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
        $errors[] = 'The resume could not be uploaded. Please try again.';
    } else {
        $max = 5 * 1024 * 1024;
        if (($file['size'] ?? 0) > $max) {
            $errors[] = 'Resume must be 5 MB or smaller.';
        }
        $original = (string) ($file['name'] ?? 'resume');
        $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        $allowed = ['pdf', 'doc', 'docx', 'txt', 'rtf'];
        if (!in_array($ext, $allowed, true)) {
            $errors[] = 'Resume must be a PDF, DOC, DOCX, TXT, or RTF file.';
        } elseif (is_uploaded_file($file['tmp_name'])) {
            $savedName = bin2hex(random_bytes(12)) . '.' . $ext;
            $destDir = dirname(__DIR__) . '/storage/resumes';
            if (!is_dir($destDir)) {
                mkdir($destDir, 0775, true);
            }
            if (!move_uploaded_file($file['tmp_name'], $destDir . '/' . $savedName)) {
                $errors[] = 'The resume could not be saved. Please try again.';
                $savedName = '';
            }
        }
    }

    if ($errors) {
        if ($savedName !== '') {
            @unlink(dirname(__DIR__) . '/storage/resumes/' . $savedName);
        }
        flash('error', implode(' ', $errors));
        redirect($back . '#apply');
    }

    append_json('applications.json', [
        'id' => bin2hex(random_bytes(8)),
        'job' => $job['slug'],
        'job_title' => $job['title'],
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'resume' => $savedName,
        'created_at' => gmdate('c'),
    ]);

    clear_old();
    flash('success', 'Application received for ' . $job['title'] . '. Thank you for your interest in OMNITECH.');
    redirect($back);
}
