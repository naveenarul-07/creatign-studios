import { motion } from 'framer-motion';
import { easeOutExpo } from '../utils/animations.js';

export function SplitLines({ lines, className = '', delay = 0, once = true }) {
  return (
    <span className={`block ${className}`}>
      {lines.map((line, index) => (
        <span key={line} className="block overflow-hidden">
          <motion.span
            className="block"
            initial={{ y: '110%' }}
            whileInView={{ y: '0%' }}
            viewport={{ once, margin: '-10%' }}
            transition={{
              duration: 1,
              delay: delay + index * 0.12,
              ease: easeOutExpo,
            }}
          >
            {line}
          </motion.span>
        </span>
      ))}
    </span>
  );
}

export function SplitWords({ text, className = '', delay = 0, highlight = [] }) {
  const words = text.split(' ');
  return (
    <span className={`inline ${className}`}>
      {words.map((word, index) => {
        const clean = word.replace(/[.,]/g, '');
        const isHot = highlight.includes(clean);
        return (
          <span key={`${word}-${index}`} className="inline-block overflow-hidden align-bottom">
            <motion.span
              className={`inline-block pr-[0.28em] ${isHot ? 'text-accent' : ''}`}
              initial={{ y: '110%', opacity: 0 }}
              whileInView={{ y: '0%', opacity: 1 }}
              viewport={{ once: true, margin: '-8%' }}
              transition={{
                duration: 0.8,
                delay: delay + index * 0.045,
                ease: easeOutExpo,
              }}
            >
              {word}
            </motion.span>
          </span>
        );
      })}
    </span>
  );
}
