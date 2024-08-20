<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HWPWeb Admin Panel</title>
  <!-- 
    UNCOMMENT IF YOU WANT TO USE AS PWA 
    - Set up your PWA application in public/manifest.json
    - Set up your PWA service worker in public/service-worker.js
    -->
  <!-- <link rel="manifest" href="<?= base_url(); ?>/manifest.json"> -->
  <meta name="theme-color" content="#e2e3e5" media="(prefers-color-scheme: light)">
  <meta name="theme-color" content="#161719" media="(prefers-color-scheme: dark)">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://getbootstrap.com/docs/5.3/examples/sign-in/sign-in.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/fontawesome/css/all.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/main.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/JawiDubai.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Color+Emoji&family=Noto+Sans+Arabic:wdth,wght@62.5..100,100..900&family=Noto+Sans+Mono:wdth,wght@62.5..100,100..900&family=Noto+Sans:ital,wdth,wght@0,62.5..100,100..900;1,62.5..100,100..900&display=swap" rel="stylesheet">
  <link href="<?= base_url() ?>assets/fonts/Geist-1.3.0/font-face.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/fonts/GeistMono-1.3.0/font-face.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/fonts/base-font/geist.css" rel="stylesheet">
  <style>
    /* Custom Scrollbar Styles */
    html {
      scrollbar-width: thin;
      /* For Firefox */
      scrollbar-color: var(--bs-secondary-color) var(--bs-border-color-translucent);
    }

    ::-webkit-scrollbar {
      width: 16px;
      height: 16px;
    }

    ::-webkit-scrollbar-track {
      background-color: var(--bs-border-color-translucent);
    }

    ::-webkit-scrollbar-thumb {
      background-color: var(--bs-secondary-color);
      border-radius: 10px;
      border: 4px solid var(--bs-border-color-translucent);
    }

    ::-webkit-scrollbar-thumb:hover {
      background-color: var(--bs-secondary-color);
    }

    ::-webkit-scrollbar-button:single-button {
      background-color: var(--bs-secondary-color);
      border: 1px solid var(--bs-border-color-translucent);
      width: 16px;
      height: 16px;
    }

    ::-webkit-scrollbar-button:single-button:vertical:decrement {
      background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23ffffff" viewBox="0 0 16 16"><path d="M4 10l4-4 4 4H4z"/></svg>');
      background-repeat: no-repeat;
      background-position: center;
    }

    ::-webkit-scrollbar-button:single-button:vertical:increment {
      background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23ffffff" viewBox="0 0 16 16"><path d="M12 6L8 10 4 6h8z"/></svg>');
      background-repeat: no-repeat;
      background-position: center;
    }

    ::-webkit-scrollbar-button:single-button:horizontal:decrement {
      background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23ffffff" viewBox="0 0 16 16"><path d="M10 12l-4-4 4-4v8z"/></svg>');
      background-repeat: no-repeat;
      background-position: center;
    }

    ::-webkit-scrollbar-button:single-button:horizontal:increment {
      background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23ffffff" viewBox="0 0 16 16"><path d="M6 4l4 4-4 4V4z"/></svg>');
      background-repeat: no-repeat;
      background-position: center;
    }

    body {
      /* You can customize background for auth page */
      background: var(--bs-secondary-bg-subtle);
      background-image: radial-gradient(var(--bs-secondary-border-subtle) 8.1333333333px, transparent 9.1333333333px), radial-gradient(var(--bs-secondary-border-subtle) 8.1333333333px, transparent 9.1333333333px), radial-gradient(var(--bs-secondary) 16.2666666667px, transparent 17.2666666667px), radial-gradient(var(--bs-secondary) 16.2666666667px, transparent 17.2666666667px), linear-gradient(135deg, var(--bs-secondary-border-subtle) 6%, var(--bs-secondary-bg-subtle) 6.45%, var(--bs-secondary-bg-subtle) 44%, transparent 46%, transparent 63%, var(--bs-secondary-bg-subtle) 63.25%), linear-gradient(45deg, transparent 39.75%, var(--bs-secondary) 40.5%, var(--bs-secondary) 60%, transparent 0, transparent 93.25%, var(--bs-secondary-border-subtle) 94%);
      background-size: 122px 122px;
      background-position: 54.4933333333px 56.9333333333px, 68.32px 56.9333333333px, -8.1333333333px -8.1333333333px, 16.2666666667px -8.1333333333px, 0 0, 0 0;
    }

    .form-signin .username {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script>
    // Uncomment to run service worker
    // if ('serviceWorker' in navigator) {
    //     window.addEventListener('load', () => {
    //         navigator.serviceWorker.register('<?= base_url(); ?>/service-worker.js')
    //             .then((registration) => {
    //                 console.log('Service Worker registered with scope:', registration.scope);
    //             })
    //             .catch((error) => {
    //                 console.error('Service Worker registration failed:', error);
    //             });
    //     });
    // }
  </script>
</head>

<body class="d-flex align-items-center py-4 text-center" id="background">

  <?= $this->renderSection('content'); ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="<?= base_url() ?>assets/fontawesome/js/all.js"></script>
  <script>
    $(document).ready(function() {
      $('input.form-control').on('input', function() {
        // Remove the is-invalid class for the current input field
        $(this).removeClass('is-invalid');
        // Hide the invalid-feedback message for the current input field
        $(this).siblings('.invalid-feedback').hide();
      });
      $(document).on('click', '#loginBtn', function(e) {
        e.preventDefault();
        $('#loginForm').submit();
        $('input').prop('disabled', true).removeClass('is-invalid');
        $('#loginBtn').prop('disabled', true).html(`
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">PLEASE WAIT...</span>
        `);
      });
      $(document).on('click', '#registerBtn', function(e) {
        e.preventDefault();
        $('#registerForm').submit();
        $('input').prop('disabled', true).removeClass('is-invalid');
        $('#registerBtn').prop('disabled', true).html(`
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">PLEASE WAIT...</span>
        `);
      });
    });
  </script>
  <script>
    /*!
     * Color mode toggler for Bootstrap's docs (https://getbootstrap.com/)
     * Copyright 2011-2023 The Bootstrap Authors
     * Licensed under the Creative Commons Attribution 3.0 Unported License.
     */

    (() => {
      'use strict'

      const getStoredTheme = () => localStorage.getItem('theme')
      const setStoredTheme = theme => localStorage.setItem('theme', theme)

      const getPreferredTheme = () => {
        const storedTheme = getStoredTheme()
        if (storedTheme) {
          return storedTheme
        }

        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
      }

      const setTheme = theme => {
        if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
          document.documentElement.setAttribute('data-bs-theme', 'dark')
        } else {
          document.documentElement.setAttribute('data-bs-theme', theme)
        }
      }

      setTheme(getPreferredTheme())

      const showActiveTheme = (theme, focus = false) => {
        const themeSwitcher = document.querySelector('#bd-theme')

        if (!themeSwitcher) {
          return
        }

        const themeSwitcherText = document.querySelector('#bd-theme-text')
        const activeThemeIcon = document.querySelector('.theme-icon-active use')
        const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
        const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')

        document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
          element.classList.remove('active')
          element.setAttribute('aria-pressed', 'false')
        })

        btnToActive.classList.add('active')
        btnToActive.setAttribute('aria-pressed', 'true')
        activeThemeIcon.setAttribute('href', svgOfActiveBtn)
        const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
        themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

        if (focus) {
          themeSwitcher.focus()
        }
      }

      window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        const storedTheme = getStoredTheme()
        if (storedTheme !== 'light' && storedTheme !== 'dark') {
          setTheme(getPreferredTheme())
        }
      })

      window.addEventListener('DOMContentLoaded', () => {
        showActiveTheme(getPreferredTheme())

        document.querySelectorAll('[data-bs-theme-value]')
          .forEach(toggle => {
            toggle.addEventListener('click', () => {
              const theme = toggle.getAttribute('data-bs-theme-value')
              setStoredTheme(theme)
              setTheme(theme)
              showActiveTheme(theme, true)
            })
          })
      })
    })()
  </script>
</body>

</html>