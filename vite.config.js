import create_config from '@kucrut/vite-for-wp';
import react from '@vitejs/plugin-react';

// https://vitejs.dev/config/
export default {
  //configuration
  ...create_config('', 'dist', { plugins: [react()] }),
};
