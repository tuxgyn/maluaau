'use strict';

/**
 * Malu AuAu — JavaScript principal.
 * Observação: os formulários abaixo ainda funcionam como demonstração local.
 * Para registrar agendamentos de verdade, será necessário integrar com um backend/API.
 */

(() => {
  const COOKIE_KEY = 'malu_cookies_accepted';
  let modalPreviousFocus = null;

  const byId = (id) => document.getElementById(id);

  const safeStorage = {
    get(key) {
      try {
        return window.localStorage.getItem(key);
      } catch (error) {
        return null;
      }
    },
    set(key, value) {
      try {
        window.localStorage.setItem(key, value);
        return true;
      } catch (error) {
        return false;
      }
    }
  };

  function escapeHtml(value) {
    const element = document.createElement('span');
    element.textContent = String(value ?? '');
    return element.innerHTML;
  }

  function normalizeText(value) {
    return String(value ?? '')
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '')
      .trim()
      .toLowerCase();
  }

  function selectMatchingOption(select, requestedValue) {
    if (!select || !requestedValue) return false;

    const requested = normalizeText(requestedValue);
    const options = Array.from(select.options);

    const match = options.find((option) => {
      const value = normalizeText(option.value);
      const label = normalizeText(option.textContent);
      return value === requested || label === requested;
    }) || options.find((option) => {
      const value = normalizeText(option.value);
      const label = normalizeText(option.textContent);
      return (value && requested.includes(value)) ||
             (label && requested.includes(label));
    });

    if (!match) return false;

    select.value = match.value;
    return true;
  }

  function formatPhone(value) {
    const digits = String(value ?? '').replace(/\D/g, '').slice(0, 11);

    if (!digits) return '';
    if (digits.length <= 2) return `(${digits}`;

    const ddd = digits.slice(0, 2);
    const number = digits.slice(2);

    if (digits.length <= 6) return `(${ddd}) ${number}`;

    const splitAt = digits.length > 10 ? 5 : 4;

    return `(${ddd}) ${number.slice(0, splitAt)}-${number.slice(splitAt)}`;
  }

  function setButtonBusy(button, busy) {
    if (!button) return;

    if (busy) {
      if (!button.dataset.originalHtml) {
        button.dataset.originalHtml = button.innerHTML;
      }

      button.disabled = true;
      button.setAttribute('aria-busy', 'true');
      button.textContent = 'Processando…';
    } else {
      button.disabled = false;
      button.removeAttribute('aria-busy');

      if (button.dataset.originalHtml) {
        button.innerHTML = button.dataset.originalHtml;
        delete button.dataset.originalHtml;
      }
    }
  }

  function closeMobileMenu() {
    const menu = byId('navMenu');
    const toggle = byId('menuToggle');

    if (menu) menu.classList.remove('open');

    if (toggle) {
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-label', 'Abrir menu');
    }
  }

  function getModalFocusableElements(modal) {
    if (!modal) return [];

    return Array.from(modal.querySelectorAll(
      'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
    )).filter((element) => element.getClientRects().length > 0);
  }

  document.addEventListener('DOMContentLoaded', () => {
    const yearEl = byId('currentYear');

    if (yearEl) {
      yearEl.textContent = String(new Date().getFullYear());
    }

    // Banner de cookies: os elementos são opcionais para evitar TypeError.
    const cookieBar = byId('cookieBar');
    const btnAccept = byId('btnAcceptCookies');

    if (cookieBar && !safeStorage.get(COOKIE_KEY)) {
      window.setTimeout(() => cookieBar.classList.add('active'), 800);
    }

    if (btnAccept && cookieBar) {
      btnAccept.addEventListener('click', () => {
        safeStorage.set(COOKIE_KEY, 'true');
        cookieBar.classList.remove('active');
      });
    }

    // Máscara de telefone, caso o campo exista nesta página.
    const phoneInput = byId('modalPhone');

    if (phoneInput) {
      phoneInput.addEventListener('input', () => {
        const cursorAtEnd =
          phoneInput.selectionStart === phoneInput.value.length;

        phoneInput.value = formatPhone(phoneInput.value);

        if (cursorAtEnd) {
          const end = phoneInput.value.length;
          phoneInput.setSelectionRange(end, end);
        }
      });
    }

    // Sombra do cabeçalho ao rolar a página.
    const header = byId('siteHeader');

    if (header) {
      const updateHeaderShadow = () => {
        header.style.boxShadow = window.scrollY > 20
          ? '0 6px 20px rgba(0, 0, 0, 0.08)'
          : 'none';
      };

      updateHeaderShadow();

      window.addEventListener(
        'scroll',
        updateHeaderShadow,
        { passive: true }
      );
    }

    // Fecha o menu ao escolher um link.
    document.querySelectorAll('.nav-link').forEach((link) => {
      link.addEventListener('click', closeMobileMenu);
    });

    // Fecha o modal ao clicar no fundo.
    const modal = byId('scheduleModal');

    if (modal) {
      modal.addEventListener('click', (event) => {
        if (event.target === modal) {
          window.closeScheduleModal();
        }
      });
    }
  });

  // Mantidas globais porque são chamadas diretamente pelo HTML.
  window.toggleMenu = function toggleMenu() {
    const menu = byId('navMenu');
    const toggle = byId('menuToggle');

    if (!menu) return;

    const isOpen = menu.classList.toggle('open');

    if (toggle) {
      toggle.setAttribute('aria-expanded', String(isOpen));
      toggle.setAttribute(
        'aria-label',
        isOpen ? 'Fechar menu' : 'Abrir menu'
      );
    }
  };

  window.handleHeroSubmit = function handleHeroSubmit(event) {
    if (event) event.preventDefault();

    const petNameInput = byId('petName');
    const serviceSelect = byId('petService');
    const petTypeSelect = byId('petType');
    const alertBox = byId('heroSuccessAlert');
    const alertMsg = byId('successAlertMessage');
    const submitBtn = byId('btnSubmitHero');

    if (!petNameInput || !serviceSelect || !petTypeSelect) return;

    const petName = petNameInput.value.trim();

    if (!petName) {
      petNameInput.setCustomValidity('Informe o nome do seu pet.');
      petNameInput.reportValidity();
      petNameInput.focus();
      return;
    }

    petNameInput.setCustomValidity('');

    if (!serviceSelect.value) {
      serviceSelect.focus();
      serviceSelect.reportValidity();
      return;
    }

    const service =
      serviceSelect.options[serviceSelect.selectedIndex]?.textContent.trim()
      || serviceSelect.value;

    const petType =
      petTypeSelect.options[petTypeSelect.selectedIndex]?.textContent.trim()
      || petTypeSelect.value;

    setButtonBusy(submitBtn, true);

    window.setTimeout(() => {
      if (alertMsg) {
        alertMsg.innerHTML =
          `Esta é uma demonstração: o pedido para ` +
          `<strong>${escapeHtml(petName)}</strong> ` +
          `(${escapeHtml(petType)}) no serviço ` +
          `<strong>${escapeHtml(service)}</strong> ainda não foi enviado ` +
          `para a equipe. Configure a integração de agendamento ` +
          `para concluir o envio.`;
      }

      if (alertBox) {
        alertBox.classList.add('show');
        alertBox.scrollIntoView({
          behavior: 'smooth',
          block: 'nearest'
        });
      }

      setButtonBusy(submitBtn, false);
    }, 300);
  };

    window.prefillService = function prefillService(serviceName) {
    const serviceSelect = byId('petService');
    const petNameInput = byId('petName');
    const bookingCard = byId('cardAgendamento');

    if (serviceSelect) {
      selectMatchingOption(serviceSelect, serviceName);
    }

    if (bookingCard) {
      bookingCard.scrollIntoView({
        behavior: 'smooth',
        block: 'nearest'
      });
    }

    window.setTimeout(() => {
      if (petNameInput) petNameInput.focus();

      if (bookingCard) {
        bookingCard.style.outline = '3px solid #0d9488';

        window.setTimeout(() => {
          bookingCard.style.outline = '';
        }, 1500);
      }
    }, 400);
  };

  window.scrollToBooking = function scrollToBooking(serviceName) {
    window.prefillService(serviceName);
  };

  window.selectPlan = function selectPlan(planName) {
    window.openScheduleModal(planName);
  };

  window.openScheduleModal = function openScheduleModal(presetService) {
    const modal = byId('scheduleModal');
    const select = byId('modalServiceSelect');
    const successMsg = byId('modalSuccessMsg');

    if (!modal) return;

    modalPreviousFocus =
      document.activeElement instanceof HTMLElement
        ? document.activeElement
        : null;

    if (successMsg) {
      successMsg.classList.remove('show');
    }

    if (select && presetService) {
      selectMatchingOption(select, presetService);
    }

    modal.classList.add('open');
    document.body.style.overflow = 'hidden';

    const closeButton = modal.querySelector(
      '[data-modal-close], .modal-close, button[aria-label*="Fechar"]'
    );

    window.setTimeout(() => {
      const firstTarget = closeButton || byId('modalTutorName');

      if (firstTarget) firstTarget.focus();
    }, 50);
  };

  window.closeScheduleModal = function closeScheduleModal() {
    const modal = byId('scheduleModal');

    if (!modal) return;

    modal.classList.remove('open');
    document.body.style.overflow = '';

    if (
      modalPreviousFocus &&
      document.contains(modalPreviousFocus)
    ) {
      modalPreviousFocus.focus();
    }

    modalPreviousFocus = null;
  };

  window.handleModalSubmit = function handleModalSubmit(event) {
    if (event) event.preventDefault();

    const form = byId('modalForm');
    const tutorInput = byId('modalTutorName');
    const phoneInput = byId('modalPhone');
    const petInput = byId('modalPetName');
    const serviceSelect = byId('modalServiceSelect');
    const successMsg = byId('modalSuccessMsg');

    if (!form || !tutorInput || !phoneInput || !petInput) return;

    const requiredInputs = [
      tutorInput,
      phoneInput,
      petInput
    ];

    const invalidInput = requiredInputs.find(
      (input) => !input.value.trim()
    );

    if (invalidInput) {
      invalidInput.setCustomValidity('Preencha este campo.');
      invalidInput.reportValidity();
      invalidInput.focus();
      return;
    }

    requiredInputs.forEach((input) => {
      input.setCustomValidity('');
    });

    const phoneDigits = phoneInput.value.replace(/\D/g, '');

    if (phoneDigits.length < 10 || phoneDigits.length > 11) {
      phoneInput.setCustomValidity(
        'Informe um telefone com DDD e número válido.'
      );

      phoneInput.reportValidity();
      phoneInput.focus();
      return;
    }

    phoneInput.setCustomValidity('');

    if (successMsg) {
      successMsg.textContent =
        'Este formulário ainda não envia o agendamento. ' +
        'A integração com o sistema de atendimento precisa ser configurada.';

      successMsg.classList.add('show');
      successMsg.setAttribute('role', 'status');
    }
  };

  // Escape fecha o modal; Tab permanece dentro dele enquanto estiver aberto.
  document.addEventListener('keydown', (event) => {
    const modal = byId('scheduleModal');

    if (!modal || !modal.classList.contains('open')) return;

    if (event.key === 'Escape') {
      event.preventDefault();
      window.closeScheduleModal();
      return;
    }

    if (event.key === 'Tab') {
      const focusable = getModalFocusableElements(modal);

      if (!focusable.length) {
        event.preventDefault();
        modal.focus();
        return;
      }

      const first = focusable[0];
      const last = focusable[focusable.length - 1];

      if (
        event.shiftKey &&
        document.activeElement === first
      ) {
        event.preventDefault();
        last.focus();
      } else if (
        !event.shiftKey &&
        document.activeElement === last
      ) {
        event.preventDefault();
        first.focus();
      }
    }
  });

    // Helpers de gráficos mantidos para compatibilidade com páginas que os utilizem.
  const chartFormatters = {
    num: (value, options) =>
      new Intl.NumberFormat('pt-BR', options || {}).format(value),

    brl: (value) =>
      new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
      }).format(value),

    pct: (value) =>
      new Intl.NumberFormat('pt-BR', {
        style: 'percent',
        maximumFractionDigits: 1
      }).format(value)
  };

  function chartAxisFormat(value) {
    return chartFormatters.num(value, {
      notation: 'compact',
      maximumFractionDigits: 1
    });
  }

  function chartCoerceFormat(spec) {
    if (typeof spec === 'function') return spec;

    if (
      typeof spec === 'string' &&
      chartFormatters[spec]
    ) {
      return chartFormatters[spec];
    }

    return (value) => chartFormatters.num(value);
  }

  function chartColor(variable, fallback) {
    return getComputedStyle(document.documentElement)
      .getPropertyValue(variable)
      .trim() || fallback;
  }

  function chartSvgElement(tag, attributes) {
    const element = document.createElementNS(
      'http://www.w3.org/2000/svg',
      tag
    );

    Object.entries(attributes).forEach(([key, value]) => {
      element.setAttribute(key, value);
    });

    return element;
  }

  function chartFrame(container, width, height) {
    const svg = chartSvgElement('svg', {
      viewBox: `0 0 ${width} ${height}`,
      role: 'img',
      'aria-label': 'Gráfico'
    });

    container.innerHTML = '';
    container.appendChild(svg);

    return svg;
  }

  function chartMax(values) {
    const maximum = values.length
      ? Math.max(...values)
      : 0;

    return maximum > 0 ? maximum : 1;
  }

  function drawBarChart(container, config) {
    if (
      !container ||
      !config ||
      !Array.isArray(config.values) ||
      !Array.isArray(config.labels) ||
      !config.values.length
    ) {
      return;
    }

    const width = 640;
    const height = 280;
    const left = 46;
    const bottom = 30;
    const top = 12;

    const svg = chartFrame(container, width, height);
    const max = chartMax(config.values);
    const plotWidth = width - left - 12;
    const plotHeight = height - top - bottom;
    const step = plotWidth / config.values.length;
    const barWidth = Math.min(step * 0.62, 64);
    const color = config.color ||
      chartColor('--accent', '#2563eb');
    const format = chartCoerceFormat(config.format);

    for (let grid = 0; grid <= 4; grid++) {
      const y = top + plotHeight -
        (plotHeight * grid) / 4;

      svg.appendChild(chartSvgElement('line', {
        x1: left,
        y1: y,
        x2: width - 12,
        y2: y,
        stroke: 'currentColor',
        'stroke-opacity': 0.08
      }));

      const label = chartSvgElement('text', {
        x: left - 8,
        y: y + 4,
        'text-anchor': 'end',
        'font-size': 10,
        fill: chartColor('--text-muted', '#5b6472')
      });

      label.textContent = chartAxisFormat((max * grid) / 4);
      svg.appendChild(label);
    }

    config.values.forEach((value, index) => {
      const barHeight = Math.max(
        0,
        (value / max) * plotHeight
      );

      const x = left + index * step +
        (step - barWidth) / 2;

      const y = top + plotHeight - barHeight;

      const rect = chartSvgElement('rect', {
        x,
        y,
        width: barWidth,
        height: barHeight,
        rx: 4,
        fill: color
      });

      const title = chartSvgElement('title', {});
      title.textContent =
        `${config.labels[index] ?? ''}: ${format(value)}`;

      rect.appendChild(title);
      svg.appendChild(rect);

      const text = chartSvgElement('text', {
        x: x + barWidth / 2,
        y: height - 10,
        'text-anchor': 'middle',
        'font-size': 11,
        fill: chartColor('--text-muted', '#5b6472')
      });

      text.textContent = config.labels[index] ?? '';
      svg.appendChild(text);
    });
  }

  function drawLineChart(container, config) {
    if (
      !container ||
      !config ||
      !Array.isArray(config.values) ||
      !Array.isArray(config.labels) ||
      !config.values.length
    ) {
      return;
    }

    const width = 640;
    const height = 280;
    const left = 46;
    const bottom = 30;
    const top = 12;

    const svg = chartFrame(container, width, height);
    const max = chartMax(config.values);
    const plotWidth = width - left - 16;
    const plotHeight = height - top - bottom;
    const color = config.color ||
      chartColor('--accent', '#2563eb');
    const format = chartCoerceFormat(config.format);

    for (let grid = 0; grid <= 4; grid++) {
      const y = top + plotHeight -
        (plotHeight * grid) / 4;

      svg.appendChild(chartSvgElement('line', {
        x1: left,
        y1: y,
        x2: width - 16,
        y2: y,
        stroke: 'currentColor',
        'stroke-opacity': 0.08
      }));

      const label = chartSvgElement('text', {
        x: left - 8,
        y: y + 4,
        'text-anchor': 'end',
        'font-size': 10,
        fill: chartColor('--text-muted', '#5b6472')
      });

      label.textContent = chartAxisFormat((max * grid) / 4);
      svg.appendChild(label);
    }

    const points = config.values.map((value, index) => [
      left + (
        config.values.length === 1
          ? plotWidth / 2
          : (plotWidth * index) /
            (config.values.length - 1)
      ),
      top + plotHeight - (value / max) * plotHeight
    ]);

    const path = points.map((point, index) =>
      `${index ? 'L' : 'M'}${point[0].toFixed(1)} ${point[1].toFixed(1)}`
    ).join(' ');

    svg.appendChild(chartSvgElement('path', {
      d: path,
      fill: 'none',
      stroke: color,
      'stroke-width': 2,
      'stroke-linejoin': 'round'
    }));

    points.forEach((point, index) => {
      const circle = chartSvgElement('circle', {
        cx: point[0],
        cy: point[1],
        r: 3.5,
        fill: color
      });

      const title = chartSvgElement('title', {});
      title.textContent =
        `${config.labels[index] ?? ''}: ${format(config.values[index])}`;

      circle.appendChild(title);
      svg.appendChild(circle);

      const text = chartSvgElement('text', {
        x: point[0],
        y: height - 10,
        'text-anchor': 'middle',
        'font-size': 11,
        fill: chartColor('--text-muted', '#5b6472')
      });

      text.textContent = config.labels[index] ?? '';
      svg.appendChild(text);
    });
  }

  function drawDonutChart(container, config) {
    if (
      !container ||
      !config ||
      !Array.isArray(config.values) ||
      !Array.isArray(config.labels) ||
      !config.values.length
    ) {
      return;
    }

    const width = 320;
    const height = 280;
    const cx = width / 2;
    const cy = height / 2;
    const outerRadius = 92;
    const innerRadius = 58;

    const svg = chartFrame(container, width, height);

    const total = config.values.reduce(
      (sum, value) => sum + value,
      0
    ) || 1;

    const palette = config.colors || [
      chartColor('--accent', '#2563eb'),
      '#1baf7a',
      '#eda100',
      '#e34948',
      '#4a3aa7',
      '#e87ba4'
    ];

    let angleStart = -Math.PI / 2;

    config.values.forEach((value, index) => {
      const angleEnd = angleStart +
        (value / total) * Math.PI * 2;

      const largeArc =
        angleEnd - angleStart > Math.PI ? 1 : 0;

      const pathData = [
        'M',
        cx + outerRadius * Math.cos(angleStart),
        cy + outerRadius * Math.sin(angleStart),
        'A',
        outerRadius,
        outerRadius,
        0,
        largeArc,
        1,
        cx + outerRadius * Math.cos(angleEnd),
        cy + outerRadius * Math.sin(angleEnd),
        'L',
        cx + innerRadius * Math.cos(angleEnd),
        cy + innerRadius * Math.sin(angleEnd),
        'A',
        innerRadius,
        innerRadius,
        0,
        largeArc,
        0,
        cx + innerRadius * Math.cos(angleStart),
        cy + innerRadius * Math.sin(angleStart),
        'Z'
      ].join(' ');

      const path = chartSvgElement('path', {
        d: pathData,
        fill: palette[index % palette.length]
      });

      const title = chartSvgElement('title', {});
      title.textContent =
        `${config.labels[index] ?? ''}: ` +
        `${chartFormatters.num(value)} ` +
        `(${chartFormatters.pct(value / total)})`;

      path.appendChild(title);
      svg.appendChild(path);

      angleStart = angleEnd;
    });

    const center = chartSvgElement('text', {
      x: cx,
      y: cy + 5,
      'text-anchor': 'middle',
      'font-size': 20,
      'font-weight': 650,
      fill: 'currentColor'
    });

    center.textContent = chartFormatters.num(total);
    svg.appendChild(center);
  }

  window.skipShell = {
    fmt: chartFormatters
  };

  window.skipChart = {
    bar: drawBarChart,
    line: drawLineChart,
    donut: drawDonutChart
  };
})();
    