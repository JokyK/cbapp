particlesJS('particles-js', {
    "particles": {
      "number": {
        "value": 30,
        "density": {
          "enable": true,
          "value_area": 800
        }
      },
      "shape": {
        "type": "circle"
      },
      "color": {
        "value": "#ffffff" // Color neón
      },
      "size": {
        "value": 20,
        "random": true
      },
      "opacity": {
        "value": 0.3,
        "anim": {
          "enable": true,
          "speed": 1,
          "opacity_min": 0.1,
          "sync": false
        }
      },
      "line_linked": {
        "enable": false // Desactivar las líneas de conexión
      },
      "move": {
        "enable": true,
        "speed": 3,
        "direction": "none",
        "random": true,
        "straight": false,
        "out_mode": "bounce",
        "bounce": false,
        "attract": {
          "enable": false
        }
      }
    },
    "interactivity": {
      "detect_on": "canvas",
      "events": {
        "onhover": {
          "enable": false, // Desactivar efecto al pasar el mouse
        },
        "onclick": {
          "enable": false,
        },
        "resize": true
      }
    },
    "retina_detect": true
  });
  