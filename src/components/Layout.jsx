import { useCallback, useEffect, useState } from 'react';
import { Outlet, useLocation } from 'react-router-dom';
import { motion } from 'framer-motion';
import Navbar from './Navbar.jsx';
import Footer from './Footer.jsx';
import CustomCursor from './CustomCursor.jsx';
import Loader from './Loader.jsx';
import Grain from './Grain.jsx';
import SmoothScroll from './SmoothScroll.jsx';
import { easeOutExpo } from '../utils/animations.js';
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
      <motion.main
        id="main"
        key={location.pathname}
        initial={reduced ? false : { opacity: 0, y: 16 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.55, ease: easeOutExpo }}
      >
        <Outlet context={{ ready }} />
      </motion.main>
      <Footer />
    </SmoothScroll>
  );
}
