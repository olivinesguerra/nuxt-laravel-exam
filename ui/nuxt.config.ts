import tailwindcss from "@tailwindcss/vite";

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },
  ssr: false,
  modules: [
    '@pinia/nuxt',
    'pinia-plugin-persistedstate/nuxt'
  ],
  pinia: { storesDirs: ['~/src/store/**'] },
  components: [
    {
      path: '~/src/components',
      pathPrefix: false,
    },
  ],
  pages: true,
  css: ['~/src/assets/css/main.css'],
  vite: {
    plugins: [
      tailwindcss(),
    ],
  },
})
