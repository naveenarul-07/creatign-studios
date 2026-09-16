import { memo, useEffect, useRef, useState } from 'react';
import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import ProjectVisual from './ProjectVisual.jsx';
import { useCursor } from '../context/CursorContext.jsx';
import { easeOutExpo } from '../utils/animations.js';

const SIZE_CLASS = {
  wide: 'md:col-span-2 md:min-h-[34rem]',
  tall: 'md:min-h-[40rem]',
  square: 'md:min-h-[28rem]',
};

function ProjectCard({ project, index }) {
  const { setCursorState } = useCursor();
  const visualRef = useRef(null);
  const [visible, setVisible] = useState(false);
  const fromLeft = index % 2 === 0;

  useEffect(() => {
    const id = window.setTimeout(() => setVisible(true), 120 + index * 90);
    return () => window.clearTimeout(id);
  }, [index]);

  const onMove = (event) => {
    const node = visualRef.current;
    if (!node) return;
    const rect = node.getBoundingClientRect();
    const px = (event.clientX - rect.left) / rect.width - 0.5;
    const py = (event.clientY - rect.top) / rect.height - 0.5;
    node.style.transform = `translate3d(${px * -18}px, ${py * -14}px, 0) scale(1.08)`;
  };

  const onLeave = () => {
    if (visualRef.current) visualRef.current.style.transform = 'translate3d(0, 0, 0) scale(1)';
    setCursorState({ variant: 'default', label: '' });
  };

  return (
    <motion.article
      className={`group relative min-h-[22rem] ${SIZE_CLASS[project.size] || SIZE_CLASS.square}`}
      initial={{ opacity: 0, x: fromLeft ? -48 : 48, rotate: fromLeft ? -1.2 : 1.2 }}
      animate={visible ? { opacity: 1, x: 0, rotate: 0 } : undefined}
      transition={{ duration: 0.9, delay: (index % 4) * 0.06, ease: easeOutExpo }}
    >
      <Link
        to={`/work/${project.id}`}
        className="focus-ring block h-full"
        onMouseEnter={() => setCursorState({ variant: 'view', label: project.name })}
        onMouseMove={onMove}
        onMouseLeave={onLeave}
      >
        <div className="relative h-full overflow-hidden">
          <div
            ref={visualRef}
            className="h-full min-h-[22rem] origin-center will-change-transform transition-transform duration-500 ease-[cubic-bezier(0.16,1,0.3,1)]"
          >
            <ProjectVisual visual={project.visual} className="h-full min-h-[22rem]" />
          </div>
          <div className="absolute inset-0 bg-gradient-to-t from-ink via-ink/0 to-transparent opacity-70" />
          <div className="absolute inset-x-0 bottom-0 translate-y-4 p-5 opacity-0 transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] group-hover:translate-y-0 group-hover:opacity-100 md:p-7">
            <p className="font-display text-[11px] tracking-[0.22em] text-accent">
              {String(index + 1).padStart(2, '0')} — {project.year}
            </p>
            <h3 className="mt-2 font-display text-[clamp(1.6rem,3vw,2.8rem)] leading-[0.95] tracking-[-0.04em]">
              {project.name}
            </h3>
            <p className="mt-2 max-w-md text-sm text-paper-dim">{project.category}</p>
          </div>
        </div>
        <div className="mt-4 flex items-end justify-between gap-4">
          <div>
            <h3 className="font-display text-xl tracking-[-0.03em] md:text-2xl">{project.title}</h3>
            <p className="mt-1 text-sm text-muted">{project.excerpt}</p>
          </div>
          <p className="shrink-0 font-display text-xs tracking-[0.18em] text-muted">
            {project.category} / {project.year}
          </p>
        </div>
      </Link>
    </motion.article>
  );
}

export default memo(ProjectCard);
