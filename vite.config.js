import create_config from '@kucrut/vite-for-wp';
import react from '@vitejs/plugin-react';

// https://vitejs.dev/config/
export default {
  // Admin configuration
  ...create_config('src/admin/main.tsx', 'dist/admin', { plugins: [react()] }),

  // User configuration
  ...create_config('src/user/main.tsx', 'dist/user', { plugins: [react()] })
};
