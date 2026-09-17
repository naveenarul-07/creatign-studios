import express from 'express';
import cors from 'cors';
import dotenv from 'dotenv';
import rateLimit from 'express-rate-limit';
import { connectDatabase } from './db.js';
import { createStore } from './models/store.js';
import { createProjectRouter } from './routes/projects.js';
import { createServiceRouter } from './routes/services.js';
import { createTestimonialRouter } from './routes/testimonials.js';
import { createContactRouter } from './routes/contact.js';
import { errorHandler, notFound } from './middleware/validate.js';

dotenv.config();

const PORT = Number(process.env.PORT) || 5000;
const CLIENT_ORIGIN = process.env.CLIENT_ORIGIN || 'http://localhost:8080';
const isProduction = process.env.NODE_ENV === 'production';

const database = await connectDatabase();
const store = createStore(database);

const app = express();

app.disable('x-powered-by');
app.use(
  cors({
    origin: isProduction ? CLIENT_ORIGIN.split(',') : true,
    methods: ['GET', 'POST', 'OPTIONS'],
  }),
);
app.use(express.json({ limit: '32kb' }));

const contactLimiter = rateLimit({
  windowMs: 15 * 60 * 1000,
  limit: 10,
  standardHeaders: true,
  legacyHeaders: false,
  message: { success: false, error: 'Too many messages. Please try again later.' },
});

app.get('/api/health', (req, res) => {
  res.json({
    success: true,
    status: 'ok',
    storage: database ? 'mysql' : 'memory',
  });
});

app.use('/api/projects', createProjectRouter(store));
app.use('/api/services', createServiceRouter(store));
app.use('/api/testimonials', createTestimonialRouter(store));
app.use('/api/contact', contactLimiter, createContactRouter(store));

app.use('/api', notFound);
app.use(errorHandler);

app.listen(PORT, '0.0.0.0', () => {
  console.log(`Creative Studio API running on http://localhost:${PORT}`);
});
