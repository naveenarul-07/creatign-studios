import { projects, services, testimonials } from '../data/content.js';
import { Project } from '../models/Project.js';
import { Service } from '../models/Service.js';
import { Testimonial } from '../models/Testimonial.js';
import { Contact } from '../models/Contact.js';

const memory = {
  projects: [...projects],
  services: [...services],
  testimonials: [...testimonials],
  contacts: [],
};

export function createStore(useMongo) {
  if (useMongo) {
    return {
      async getProjects() {
        const docs = await Project.find().lean();
        return docs.length ? docs : memory.projects;
      },
      async getProject(id) {
        const doc = await Project.findOne({ id }).lean();
        return doc || memory.projects.find((item) => item.id === id) || null;
      },
      async getServices() {
        const docs = await Service.find().lean();
        return docs.length ? docs : memory.services;
      },
      async getTestimonials() {
        const docs = await Testimonial.find().lean();
        return docs.length ? docs : memory.testimonials;
      },
      async createContact(payload) {
        const doc = await Contact.create(payload);
        return doc.toObject();
      },
    };
  }

  return {
    async getProjects() {
      return memory.projects;
    },
    async getProject(id) {
      return memory.projects.find((item) => item.id === id) || null;
    },
    async getServices() {
      return memory.services;
    },
    async getTestimonials() {
      return memory.testimonials;
    },
    async createContact(payload) {
      const entry = { id: `c_${Date.now()}`, ...payload, createdAt: new Date().toISOString() };
      memory.contacts.push(entry);
      return entry;
    },
  };
}
