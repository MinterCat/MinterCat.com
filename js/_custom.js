'use strict';

document.addEventListener("DOMContentLoaded", function () {

  (function () {
    let cards = document.querySelector('.cards'),
      profile = document.querySelector('.profile-info'),
      intro = document.querySelector('.intro'),
      header = document.querySelector('.top-header');

    let displayModal = (className) => {
      let overlay = document.querySelector(className);

      overlay.classList.add('active');
      if (!overlay.classList.contains('overlay--modal-card')) {
        document.body.style.overflow = 'hidden';
      }

      overlay.addEventListener('click', (e) => {
        let btnClose = e.target.closest('.js-close-modal'),
          btnSave = e.target.classList.contains('modal-rename__btn-save'),
          btnLoginClose = e.target.closest('.overlay__close'),
          btnCancel = e.target.classList.contains('modal-rename__btn-cancel'),
          modalLoginLink = e.target.classList.contains('modal-login__link');

        if (btnClose || btnCancel || btnLoginClose) {
          overlay.classList.remove('active');
          document.body.style.overflow = '';
          return;
        };

        if (btnSave) {
          overlay.classList.remove('active');
          document.body.style.overflow = '';

          changeName();
        }

        if (modalLoginLink) {
          overlay.classList.remove('active');
          (overlay.classList.contains('overlay--login') ? displayModal('.overlay--reg') : displayModal('.overlay--login'));
          return;
        }
      });
    };

    let changeName = () => {
      let name = document.querySelector('.profile-info__name'),
        input = document.querySelector('.modal-rename__input');

      name.textContent = input.value;
    }

    let doFixedHeader = () => {
      let header = document.querySelector('.top-header');

      if (document.documentElement.scrollTop > 40) {
        header.classList.add('top-header--fixed');
      } else {
        header.classList.remove('top-header--fixed');
      }
    }

    let openMenu = () => {
      let navMenu = document.querySelector('.nav-top'),
          close   = document.querySelector('.nav-top__close');

      navMenu.classList.add('active');
      document.body.style.overflow = 'hidden';

      close.addEventListener('click', () => {
        navMenu.classList.remove('active');
        document.body.style.overflow = '';
      });
    };

    // Events

    if (cards) {
      cards.addEventListener('click', (e) => {
        let card = e.target.closest('.card');

        if (!card) return;

        displayModal('.overlay--modal-card');
      });
    }

    if (profile) {
      profile.addEventListener('click', (e) => {
        let target = e.target;
        e.preventDefault();

        if (target.classList.contains('js-open-modal')) {
          displayModal('.overlay--rename');
        }
      });
    }

    if (intro) {
      intro.addEventListener('click', (e) => {
        let target = e.target;

        if (target.classList.contains('btn')) {
          displayModal('.overlay--login');
        }
      });
    }

    if (header) {
      header.addEventListener('click', (e) => {
        let target = e.target;

        // console.log(target.closest('.btn-hamburger'));

        if (target.closest('.btn-hamburger')) {
          openMenu();
        }

        if (target.classList.contains('top-header__btn-play')) {
          displayModal('.overlay--login');
        }
      });
    }

    window.addEventListener('scroll', doFixedHeader);

    window.addEventListener('load', doFixedHeader);

  }());

});
