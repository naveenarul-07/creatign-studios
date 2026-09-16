import { useEffect, useRef, useState } from 'react';

const ITEMS = [
  'BRANDING',
  'DIGITAL EXPERIENCES',
  'CREATIVE DEVELOPMENT',
  'MOTION',
  'STRATEGY',
  'IDENTITY',
];

export default function Marquee() {
  const [paused, setPaused] = useState(false);
  const [scale, setScale] = useState(1);
  const lastY = useRef(0);
  const speedRef = useRef(1);
  const trackRef = useRef(null);

  useEffect(() => {
    lastY.current = window.scrollY;
    const onScroll = () => {
      const current = window.scrollY;
      const delta = Math.min(Math.abs(current - lastY.current) / 40, 1.8);
      lastY.current = current;
      speedRef.current = 1 + delta;
      if (trackRef.current) {
        trackRef.current.style.animationDuration = `${28 / speedRef.current}s`;
      }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  const content = [...ITEMS, ...ITEMS];

  return (
    <section
      className="relative overflow-hidden border-y border-line py-6 md:py-8"
      onMouseEnter={() => {
        setPaused(true);
        setScale(1.06);
      }}
      onMouseLeave={() => {
        setPaused(false);
        setScale(1);
      }}
      aria-label="Capabilities marquee"
    >
      <div
        ref={trackRef}
        className={`marquee-track flex w-max gap-10 ${paused ? 'is-paused' : ''}`}
        style={{ transform: `scale(${scale})`, transformOrigin: 'center left' }}
      >
        {content.map((item, index) => (
          <span
            key={`${item}-${index}`}
            className="flex items-center gap-10 font-display text-[clamp(1.8rem,5vw,4.4rem)] font-medium tracking-[-0.05em] whitespace-nowrap"
          >
            {item}
            <span className="text-accent">—</span>
          </span>
        ))}
      </div>
    </section>
  );
}
