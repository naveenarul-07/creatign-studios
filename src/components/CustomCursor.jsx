import { useEffect, useRef } from 'react';
import { useCursor } from '../context/CursorContext.jsx';

export default function CustomCursor() {
  const { enabled, cursor } = useCursor();
  const dotRef = useRef(null);
  const ringRef = useRef(null);
  const pos = useRef({ x: 0, y: 0, rx: 0, ry: 0 });
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
      pos.current.x += (target.current.x - pos.current.x) * 0.35;
      pos.current.y += (target.current.y - pos.current.y) * 0.35;
      pos.current.rx += (target.current.x - pos.current.rx) * 0.16;
      pos.current.ry += (target.current.y - pos.current.ry) * 0.16;

      if (dotRef.current) {
        dotRef.current.style.transform = `translate3d(${pos.current.x}px, ${pos.current.y}px, 0)`;
      }
      if (ringRef.current) {
        ringRef.current.style.transform = `translate3d(${pos.current.rx}px, ${pos.current.ry}px, 0)`;
      }
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

  const expanded = cursor.variant === 'link' || cursor.variant === 'button' || cursor.variant === 'view';
  const view = cursor.variant === 'view';

  return (
    <div className="pointer-events-none fixed inset-0 z-[100] hidden md:block" aria-hidden="true">
      <div
        ref={dotRef}
        className="absolute top-0 left-0 h-2 w-2 -translate-x-1/2 -translate-y-1/2 rounded-full bg-accent mix-blend-difference"
      />
      <div
        ref={ringRef}
        className="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2"
      >
        <div
          className={`flex items-center justify-center rounded-full border border-paper/70 bg-paper/0 text-center font-display text-[10px] font-medium tracking-[0.18em] text-ink mix-blend-difference transition-[width,height,background-color,border-color] duration-300 ease-[cubic-bezier(0.16,1,0.3,1)] ${
            view
              ? 'h-28 w-28 border-accent bg-accent text-ink'
              : expanded
                ? 'h-16 w-16 border-accent'
                : 'h-10 w-10'
          }`}
        >
          {view ? (
            <span className="max-w-[5.5rem] px-2 leading-tight mix-blend-normal">
              {cursor.label || 'VIEW'}
            </span>
          ) : null}
        </div>
      </div>
    </div>
  );
}
