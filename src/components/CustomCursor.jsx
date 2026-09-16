import { useEffect, useRef } from 'react';
import { useCursor } from '../context/CursorContext.jsx';

const TRAIL = 5;

export default function CustomCursor() {
  const { enabled, cursor } = useCursor();
  const plusRef = useRef(null);
  const squareRef = useRef(null);
  const trailRefs = useRef([]);
  const pos = useRef({ x: 0, y: 0, sx: 0, sy: 0 });
  const trail = useRef(Array.from({ length: TRAIL }, () => ({ x: 0, y: 0 })));
  const target = useRef({ x: 0, y: 0 });

  useEffect(() => {
    if (!enabled) {
      document.body.classList.remove('has-custom-cursor');
      return undefined;
    }
    document.body.classList.add('has-custom-cursor');

    const onMove = (event) => {
      target.current = { x: event.clientX, y: event.clientY };
    };

    const tick = () => {
      pos.current.x += (target.current.x - pos.current.x) * 0.42;
      pos.current.y += (target.current.y - pos.current.y) * 0.42;
      pos.current.sx += (target.current.x - pos.current.sx) * 0.14;
      pos.current.sy += (target.current.y - pos.current.sy) * 0.14;

      if (plusRef.current) {
        plusRef.current.style.transform = `translate3d(${pos.current.x}px, ${pos.current.y}px, 0)`;
      }
      if (squareRef.current) {
        squareRef.current.style.transform = `translate3d(${pos.current.sx}px, ${pos.current.sy}px, 0)`;
      }

      let prev = { x: pos.current.sx, y: pos.current.sy };
      trail.current.forEach((point, index) => {
        point.x += (prev.x - point.x) * (0.22 - index * 0.02);
        point.y += (prev.y - point.y) * (0.22 - index * 0.02);
        const node = trailRefs.current[index];
        if (node) {
          node.style.transform = `translate3d(${point.x}px, ${point.y}px, 0)`;
        }
        prev = point;
      });

      frame = requestAnimationFrame(tick);
    };

    let frame = requestAnimationFrame(tick);
    window.addEventListener('mousemove', onMove, { passive: true });
    return () => {
      document.body.classList.remove('has-custom-cursor');
      window.removeEventListener('mousemove', onMove);
      cancelAnimationFrame(frame);
    };
  }, [enabled]);

  if (!enabled) return null;

  const view = cursor.variant === 'view';
  const expanded = cursor.variant === 'link' || cursor.variant === 'button' || view;

  return (
    <div className="pointer-events-none fixed inset-0 z-[100] hidden md:block" aria-hidden="true">
      {Array.from({ length: TRAIL }).map((_, index) => (
        <div
          key={index}
          ref={(node) => {
            trailRefs.current[index] = node;
          }}
          className="absolute top-0 left-0 h-1.5 w-1.5 -translate-x-1/2 -translate-y-1/2 bg-accent"
          style={{ opacity: 0.35 - index * 0.05 }}
        />
      ))}

      <div
        ref={plusRef}
        className={`absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 transition-transform duration-300 ${
          expanded ? 'rotate-45 scale-125' : 'rotate-0'
        }`}
      >
        <span className="absolute top-1/2 left-1/2 h-px w-3.5 -translate-x-1/2 -translate-y-1/2 bg-paper" />
        <span className="absolute top-1/2 left-1/2 h-3.5 w-px -translate-x-1/2 -translate-y-1/2 bg-paper" />
      </div>

      <div ref={squareRef} className="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2">
        <div
          className={`flex items-center justify-center border font-display text-[10px] font-medium tracking-[0.18em] text-ink transition-[width,height,background-color,border-color,border-radius,transform] duration-300 ease-[cubic-bezier(0.16,1,0.3,1)] ${
            view
              ? 'h-24 w-24 rotate-0 border-accent bg-accent'
              : expanded
                ? 'h-9 w-9 border-accent bg-transparent'
                : 'h-6 w-6 border-paper/50 bg-transparent'
          }`}
        >
          {view ? <span className="px-2 text-center leading-tight">{cursor.label || 'VIEW'}</span> : null}
        </div>
      </div>
    </div>
  );
}
