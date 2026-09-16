import { useEffect, useRef } from 'react';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { PROCESS_STEPS } from '../data/site.js';
import { registerGsap } from '../utils/animations.js';
import { useIsMobile, usePrefersReducedMotion } from '../hooks/useMediaQuery.js';

export default function Process() {
  const sectionRef = useRef(null);
  const trackRef = useRef(null);
  const progressRef = useRef(null);
  const isMobile = useIsMobile();
  const reduced = usePrefersReducedMotion();

  useEffect(() => {
    registerGsap();
    if (isMobile || reduced || !sectionRef.current || !trackRef.current) return undefined;

    const ctx = gsap.context(() => {
      const track = trackRef.current;
      const distance = () => track.scrollWidth - window.innerWidth;

      gsap.to(track, {
        x: () => -distance(),
        ease: 'none',
        scrollTrigger: {
          trigger: sectionRef.current,
          start: 'top top',
          end: () => `+=${distance()}`,
          pin: true,
          scrub: 0.6,
          anticipatePin: 1,
          invalidateOnRefresh: true,
          onUpdate: (self) => {
            if (progressRef.current) {
              progressRef.current.style.transform = `scaleX(${self.progress})`;
            }
          },
        },
      });
    }, sectionRef);

    return () => {
      ctx.revert();
      ScrollTrigger.refresh();
    };
  }, [isMobile, reduced]);

  return (
    <section ref={sectionRef} className="relative overflow-hidden bg-ink-soft" id="process">
      <div className="flex items-center justify-between px-5 py-8 md:px-10">
        <h2 className="font-display text-[clamp(2rem,5vw,4.5rem)] font-medium tracking-[-0.05em]">
          HOW WE WORK
        </h2>
        <span className="font-display text-xs tracking-[0.24em] text-muted">05 — PROCESS</span>
      </div>
      <div className="mx-5 mb-4 h-px bg-line md:mx-10">
        <div
          ref={progressRef}
          className="h-px origin-left scale-x-0 bg-accent"
        />
      </div>
      <div
        ref={trackRef}
        className="flex w-max gap-6 px-5 pb-16 md:gap-10 md:px-10 md:pb-24"
      >
        {PROCESS_STEPS.map((step) => (
          <article
            key={step.number}
            className="w-[min(85vw,32rem)] shrink-0 border border-line bg-ink p-8 md:p-12"
          >
            <p className="font-display text-accent">{step.number}</p>
            <h3 className="mt-8 font-display text-[clamp(2rem,4vw,4rem)] tracking-[-0.05em]">
              {step.name}
            </h3>
            <p className="mt-6 max-w-sm text-sm leading-relaxed text-paper-dim">{step.body}</p>
          </article>
        ))}
      </div>
    </section>
  );
}
