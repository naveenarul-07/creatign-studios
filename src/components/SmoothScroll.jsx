import { useEffect } from 'react';
import Lenis from 'lenis';
import 'lenis/dist/lenis.css';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { registerGsap } from '../utils/animations.js';
import { usePrefersReducedMotion } from '../hooks/useMediaQuery.js';

export default function SmoothScroll({ children }) {
  const reduced = usePrefersReducedMotion();

  useEffect(() => {
    if (reduced) return undefined;
    registerGsap();
    const lenis = new Lenis({
      duration: 1.15,
      smoothWheel: true,
      wheelMultiplier: 0.95,
    });
    lenis.on('scroll', ScrollTrigger.update);
    const ticker = (time) => {
      lenis.raf(time * 1000);
    };
    gsap.ticker.add(ticker);
    gsap.ticker.lagSmoothing(0);
    requestAnimationFrame(() => ScrollTrigger.refresh());
    return () => {
      gsap.ticker.remove(ticker);
      lenis.destroy();
    };
  }, [reduced]);

  return children;
}
