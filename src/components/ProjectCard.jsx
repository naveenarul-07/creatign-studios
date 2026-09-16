import { memo } from 'react';
import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import ProjectVisual from './ProjectVisual.jsx';
import { useCursor } from '../context/CursorContext.jsx';
import { clipReveal, easeOutExpo } from '../utils/animations.js';

const SIZE_CLASS = {
  wide: 'md:col-span-2 md:min-h-[34rem]',
  tall: 'md:min-h-[40rem]',
  square: 'md:min-h-[28rem]',
};

function ProjectCard({ project, index }) {
  const { setCursorState } = useCursor();

  return (
    <motion.article
      className={`group relative min-h-[22rem] ${SIZE_CLASS[project.size] || SIZE_CLASS.square}`}
      initial="hidden"
      whileInView="visible"
      viewport={{ once: true, margin: '-12%' }}
      transition={{ delay: (index % 3) * 0.08 }}
    >
      <Link
        to={`/work/${project.id}`}
        className="focus-ring block h-full"
        onMouseEnter={() =>
          setCursorState({ variant: 'view', label: 'VIEW CASE STUDY' })
        }
        onMouseLeave={() => setCursorState({ variant: 'default', label: '' })}
      >
        <motion.div className="h-full overflow-hidden" variants={clipReveal}>
          <div className="h-full origin-center transition-transform duration-700 ease-[cubic-bezier(0.16,1,0.3,1)] group-hover:scale-[1.06]">
            <ProjectVisual visual={project.visual} title={project.name} className="h-full min-h-[22rem]" />
          </div>
        </motion.div>
        <motion.div
          className="mt-4 flex items-end justify-between gap-4"
          initial={{ opacity: 0, y: 16 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.7, delay: 0.15, ease: easeOutExpo }}
        >
          <div>
            <h3 className="font-display text-xl tracking-[-0.03em] md:text-2xl">{project.title}</h3>
            <p className="mt-1 text-sm text-muted">{project.excerpt}</p>
          </div>
          <p className="shrink-0 font-display text-xs tracking-[0.18em] text-muted">
            {project.category} / {project.year}
          </p>
        </motion.div>
      </Link>
    </motion.article>
  );
}

export default memo(ProjectCard);
