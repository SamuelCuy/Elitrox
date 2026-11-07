/* Funciones compartidas de ELITROX: menú, tema y consejos de seguridad. */
document.addEventListener('DOMContentLoaded', () => {
  const menuBtn = document.getElementById('menuBtn');
  const menu = document.getElementById('menu');
  if (menuBtn && menu) {
    menuBtn.addEventListener('click', () => {
      const abierto = menu.classList.toggle('abierto');
      menuBtn.setAttribute('aria-expanded', String(abierto));
      menuBtn.setAttribute('aria-label', abierto ? 'Cerrar menú' : 'Abrir menú');
      menuBtn.textContent = abierto ? '✕' : '☰';
    });
    menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
      menu.classList.remove('abierto'); menuBtn.setAttribute('aria-expanded','false'); menuBtn.textContent='☰';
    }));
  }
  const modoBtn = document.getElementById('modoBtn');
  if (modoBtn) {
    let claro = false;
    modoBtn.addEventListener('click', () => {
      claro = !claro;
      document.body.classList.toggle('tema-claro', claro);
      modoBtn.textContent = claro ? '☀️' : '🌙';
      modoBtn.setAttribute('aria-label', claro ? 'Cambiar a tema oscuro' : 'Cambiar a tema claro');
    });
  }
  const consejos = [
    'Usa siempre un casco certificado y correctamente abrochado.',
    'Revisa presión de neumáticos, frenos y luces antes de salir.',
    'Mantén una distancia segura y adapta la velocidad a la vía.',
    'Hazte visible con prendas reflectivas, especialmente de noche.',
    'No conduzcas bajo los efectos del alcohol ni del cansancio.',
    'Señaliza con anticipación y revisa los puntos ciegos antes de cambiar de carril.'
  ];
  const consejoBtn = document.getElementById('consejoBtn');
  const mensajeConsejo = document.getElementById('mensajeConsejo');
  if (consejoBtn && mensajeConsejo) {
    consejoBtn.addEventListener('click', () => {
      const actual = mensajeConsejo.textContent.trim();
      const disponibles = consejos.filter(c => c !== actual);
      mensajeConsejo.textContent = disponibles[Math.floor(Math.random() * disponibles.length)];
    });
  }
});
