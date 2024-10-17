document.addEventListener("DOMContentLoaded", function () {
    const scrambleLinks = document.querySelectorAll('.scramble-link');
  
    function initializeScrambleEffect() {
      if (window.innerWidth > 800) {
        scrambleLinks.forEach(link => {
          let originalText = link.textContent;
          let linkWidth = link.offsetWidth;
  
          link.style.display = 'inline-block';
          link.style.width = `${linkWidth}px`;
          link.style.textAlign = 'center';
  
          link.addEventListener('mouseover', function () {
            const scrambleInterval = setInterval(() => {
              link.textContent = scrambleText(originalText);
            }, 50);
  
            link.addEventListener('mouseleave', function () {
              clearInterval(scrambleInterval);
              link.textContent = originalText; 
            });
          });
        });
      } else {
        scrambleLinks.forEach(link => {
          link.style.display = '';
          link.style.width = '';
          link.style.textAlign = '';
        });
      }
    }
  
    function scrambleText(text) {
      const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+[]{}|;:,./<>?';
      return text.split('').map(char => {
        return characters.charAt(Math.floor(Math.random() * characters.length));
      }).join('');
    }
  
    initializeScrambleEffect();

    window.addEventListener('resize', initializeScrambleEffect);
  });
  