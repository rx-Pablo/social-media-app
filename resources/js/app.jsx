// resources/js/app.jsx
import React from 'react'
import { createRoot } from 'react-dom/client'
import { createInertiaApp } from '@inertiajs/inertia-react'

// Esta línea es clave: Inertia usa esta función para localizar el componente
createInertiaApp({
  resolve: name => import(`./Pages/${name}`), 
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />)
  },
})
