import { useCallback, useEffect, useState } from 'react';
import { Outlet, useLocation } from 'react-router-dom';
import { AnimatePresence, motion } from 'framer-motion';
import Navbar from './Navbar.jsx';
import Footer from './Footer.jsx';
import CustomCursor from './CustomCursor.jsx';
import Loader from './Loader.jsx';
import Grain from './Grain.jsx';
import SmoothScroll from './SmoothScroll.jsx';
import { pageTransition } from '../utils/animations.js';
import { usePrefersReducedMotion } from '../hooks/useMediaQuery.js';

export default function Layout() {
  const location = useLocation();
  const reduced = usePrefersReducedMotion();
  const [ready, setReady] = useState(false);
  const handleComplete = useCallback(() => setReady(true), []);

  useEffect(() => {
    if (location.hash) {
      const node = document.querySelector(location.hash);
      if (node) {
        node.scrollIntoView({ behavior: 'smooth' });
        return;
      }
    }
    window.scrollTo(0, 0);
  }, [location.pathname, location.hash]);

  return (
    <SmoothScroll>
      <a
        href="#main"
        className="focus-ring sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[120] focus:bg-accent focus:px-4 focus:py-2 focus:text-ink"
      >
        Skip to content
      </a>
      <Grain />
      <CustomCursor />
      <Loader onComplete={handleComplete} />
      <Navbar ready={ready} />
      <AnimatePresence mode="wait">
        <motion.main
          id="main"
          key={location.pathname}
          {...pageTransition(reduced)}
        >
          <Outlet context={{ ready }} />
        </motion.main>
      </AnimatePresence>
      <Footer />
    </SmoothScroll>
  );
}
