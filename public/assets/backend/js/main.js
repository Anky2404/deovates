/**
 * Main
 */

'use strict';

let menu, animate;

// DOMContentLoaded Function
document.addEventListener('DOMContentLoaded', function () {

  if (navigator.userAgent.match(/iPhone|iPad|iPod/i)) {
    document.body.classList.add('ios');
  }
});

// Main Function
(function () {

  // Initialize Menu Function
  let layoutMenuEl = document.querySelectorAll('#layout-menu');

  layoutMenuEl.forEach(function (element) {

    menu = new Menu(element, {
      orientation: 'vertical',
      closeChildren: false
    });

    window.Helpers.scrollToActive((animate = false));
    window.Helpers.mainMenu = menu;
  });

  // Menu Toggler Function
  let menuToggler = document.querySelectorAll('.layout-menu-toggle');

  menuToggler.forEach(item => {

    item.addEventListener('click', event => {

      event.preventDefault();
      window.Helpers.toggleCollapsed();
    });
  });

  // Delay Function
  let delay = function (elem, callback) {

    let timeout = null;

    elem.onmouseenter = function () {

      if (!Helpers.isSmallScreen()) {
        timeout = setTimeout(callback, 300);
      } else {
        timeout = setTimeout(callback, 0);
      }
    };

    elem.onmouseleave = function () {

      document
        .querySelector('.layout-menu-toggle')
        .classList.remove('d-block');

      clearTimeout(timeout);
    };
  };

  // Layout Menu Function
  if (document.getElementById('layout-menu')) {

    delay(document.getElementById('layout-menu'), function () {

      if (!Helpers.isSmallScreen()) {

        document
          .querySelector('.layout-menu-toggle')
          .classList.add('d-block');
      }
    });
  }

  // Menu Scroll Function
  let menuInnerContainer = document.getElementsByClassName('menu-inner'),
      menuInnerShadow = document.getElementsByClassName('menu-inner-shadow')[0];

  if (menuInnerContainer.length > 0 && menuInnerShadow) {

    menuInnerContainer[0].addEventListener('ps-scroll-y', function () {

      if (this.querySelector('.ps__thumb-y').offsetTop) {
        menuInnerShadow.style.display = 'block';
      } else {
        menuInnerShadow.style.display = 'none';
      }
    });
  }

  // Tooltip Function
  const tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );

  tooltipTriggerList.map(function (tooltipTriggerEl) {

    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Accordion Active Function
  const accordionActiveFunction = function (e) {

    if (
      e.type == 'show.bs.collapse' ||
      e.type == 'show.bs.collapse'
    ) {

      e.target
        .closest('.accordion-item')
        .classList.add('active');

    } else {

      e.target
        .closest('.accordion-item')
        .classList.remove('active');
    }
  };

  // Accordion Trigger Function
  const accordionTriggerList = [].slice.call(
    document.querySelectorAll('.accordion')
  );

  const accordionList = accordionTriggerList.map(function (accordionTriggerEl) {

    accordionTriggerEl.addEventListener(
      'show.bs.collapse',
      accordionActiveFunction
    );

    accordionTriggerEl.addEventListener(
      'hide.bs.collapse',
      accordionActiveFunction
    );
  });

  // Auto Update Function
  window.Helpers.setAutoUpdate(true);

  // Password Toggle Function
  window.Helpers.initPasswordToggle();

  // Speech To Text Function
  window.Helpers.initSpeechToText();

  // Small Screen Function
  if (window.Helpers.isSmallScreen()) {
    return;
  }

  // Collapsed Menu Function
  window.Helpers.setCollapsed(true, false);

})();

// isMacOS Function
function isMacOS() {

  return /Mac|iPod|iPhone|iPad/.test(navigator.userAgent);
}
