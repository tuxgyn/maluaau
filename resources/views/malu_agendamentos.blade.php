!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Malu AuAu — O melhor para o seu melhor amigo</title>
  <!-- SEO básico -->
  <meta name="description" content="Banho e tosa, consultas veterinárias, hospedagem e planos de saúde pet na Malu AuAu. Atendimento humanizado, sem estresse e com veterinários 24h.">
  <meta property="og:type" content="website">
  <meta property="og:title" content="Malu AuAu — O melhor para o seu melhor amigo">
  <meta property="og:description" content="Cuidado veterinário de confiança, banho sem estresse, hotel pet e planos de saúde preventivos.">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:image" content="{{ asset('img/ref-malu-hero.svg') }}">
  {{-- TODO: criar o favicon e salvar em public/img/favicon.svg --}}
  <link rel="icon" href="{{ asset('img/favicon.svg') }}" type="image/svg+xml">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap">
  <!-- Basecoat & estilos do projeto -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/basecoat-css@1.0.2/dist/basecoat.cdn.min.css">
  <link rel="stylesheet" href="{{ asset('style/style.css') }}">
  <script src="{{ asset('jscript/jscript.js') }}" defer></script>
</head>
<body>

  @if (session('success'))
    <div class="success-alert show alert-top" role="status">
      {{ session('success') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="success-alert show alert-error" role="alert">
      <strong>Não foi possível enviar sua solicitação:</strong>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- 1) Header fixo -->
  <header class="site-header" id="siteHeader">
    <div class="header-inner">
      <a href="#inicio" class="logo-container" aria-label="Malu AuAu Início — Mascote Pug Malu">
        <div class="logo-badge" title="Malu a Pug">
          <img src="{{ asset('img/ref-malu-logo-header.svg') }}" width="32" height="32" alt="" aria-hidden="true">
        </div>
        <div>
          <span class="brand-name">Malu AuAu</span>
          <div class="brand-tag">Amor &amp; Saúde Pet</div>
        </div>
      </a>
      <nav aria-label="Menu principal">
        <ul class="nav-menu" id="navMenu">
          <li><a href="#servicos" class="nav-link">Serviços</a></li>
          <li><a href="#planos" class="nav-link">Planos</a></li>
          <li><a href="#sobre" class="nav-link">Sobre</a></li>
          <li><a href="#depoimentos" class="nav-link">Depoimentos</a></li>
          <li><a href="#contato" class="nav-link">Contato</a></li>
        </ul>
      </nav>
      <div class="header-actions">
        <button type="button" class="btn-cta" id="btnHeaderCta" data-action="open-modal">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
          Agendar agora
        </button>
        <button type="button" class="menu-toggle" id="menuToggle" aria-label="Abrir menu" aria-expanded="false" aria-controls="navMenu" data-action="toggle-menu">
          <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </header>

  <!-- 0) Cadastro do usuário — atalho para a página de cadastro -->
  <section class="cadastro-section" id="cadastro">
    <div class="cadastro-card">
      <span class="booking-card-ribbon">Novo por aqui?</span>
      <h2 class="booking-card-title">Cadastre-se na Malu AuAu</h2>
      <p class="booking-card-desc">
        Crie seu cadastro e o do seu pet para agilizar o seu atendimento.
      </p>
      <a href="{{ route('cadastro.create') }}" class="btn-cta btn-cta--dark cadastro-cta">
        🐾 Quero me cadastrar
      </a>
    </div>
  </section>

  <!-- 2) Hero -->
  <section class="hero-section" id="inicio">
    <img class="doodle-bg doodle-dog" src="{{ asset('img/ref-doodle-dog.svg') }}" alt="" aria-hidden="true">
    <img class="doodle-bg doodle-pug-1" src="{{ asset('img/ref-doodle-pug-1.svg') }}" alt="" aria-hidden="true">
    <img class="doodle-bg doodle-cat" src="{{ asset('img/ref-doodle-cat.svg') }}" alt="" aria-hidden="true">
    <img class="doodle-bg doodle-pug-2" src="{{ asset('img/ref-doodle-pug-2.svg') }}" alt="" aria-hidden="true">
    <img class="doodle-bg doodle-paw-1" src="{{ asset('img/ref-doodle-paw-1.svg') }}" alt="" aria-hidden="true">
    <img class="doodle-bg doodle-paw-2" src="{{ asset('img/ref-doodle-paw-2.svg') }}" alt="" aria-hidden="true">
    <img class="doodle-bg doodle-heart" src="{{ asset('img/ref-doodle-heart.svg') }}" alt="" aria-hidden="true">

    <div class="hero-container">
      <div class="hero-visual-card">
        <img class="hero-image" src="{{ asset('img/ref-malu-hero.svg') }}" alt="Ilustração da Mascote Malu, uma pug carismática, sorridente e cheia de amor">
        <div class="hero-overlay"></div>
        <div class="hero-content">
          <div class="hero-text-wrap">
            <div class="hero-badge-tag">
              <span>🐾</span> Atendimento humanizado e carinhoso
            </div>
            <h1 class="hero-title">O melhor para o seu melhor amigo</h1>
            <p class="hero-subtitle">
              Cuidado veterinário de confiança, banho relaxante com cromoterapia, hotel com recreação livre e planos de saúde preventivos sob medida.
            </p>
            <div class="hero-highlights">
              <span class="hero-pill-info">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"></path></svg>
                Sem gaiolas ou estresse
              </span>
              <span class="hero-pill-info">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"></path></svg>
                Veterinários 24h
              </span>
              <span class="hero-pill-info">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"></path></svg>
                Transparência por vídeo
              </span>
            </div>
          </div>

          <!-- Formulário rápido (mesmos campos do modal) -->
          <div class="booking-card" id="cardAgendamento">
            <span class="booking-card-ribbon">Rápido &amp; Fácil</span>
            <h2 class="booking-card-title">Encontre o serviço ideal para seu pet</h2>
            <p class="booking-card-desc">Informe os dados básicos para receber atendimento personalizado com carinho:</p>
            <form id="heroServiceForm" action="{{ route('agendamentos.store') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="heroTutorName" class="form-label">Seu nome (Tutor)</label>
                <input type="text" id="heroTutorName" name="tutor_name" class="form-control-custom"
                       placeholder="Ex: Maria Oliveira" autocomplete="name" required>
              </div>
              <div class="form-group">
                <label for="heroPhone" class="form-label">WhatsApp com DDD</label>
                <input type="tel" id="heroPhone" name="phone" class="form-control-custom js-phone"
                       placeholder="(62) 9XXXX-XXXX" inputmode="numeric" autocomplete="tel"
                       maxlength="15" required>
              </div>
              <div class="form-group">
                <label for="petName" class="form-label">Nome do seu pet</label>
                <input type="text" id="petName" name="pet_name" class="form-control-custom"
                       placeholder="Ex: Paçoca, Pipoca, Thor..." required>
              </div>
              <div class="form-group">
                <label for="petType" class="form-label">Tipo de pet</label>
                <select id="petType" name="pet_type" class="form-control-custom">
                  <option value="cachorro">🐶 Cãozinho</option>
                  <option value="gato">🐱 Gatinho</option>
                  <option value="outro">🐰 Outro Pet</option>
                </select>
              </div>
              <div class="form-group">
                <label for="petService" class="form-label">Serviço desejado</label>
                <select id="petService" name="service" class="form-control-custom" required>
                  <option value="banho_tosa">Banho e Tosa</option>
                  <option value="consulta">Consulta Veterinária</option>
                  <option value="hospedagem">Hospedagem &amp; Day Care</option>
                  <option value="plano_leve">Plano AuAu Leve</option>
                  <option value="plano_conforto">Plano AuAu Conforto</option>
                  <option value="plano_vip">Plano AuAu VIP Care</option>
                </select>
              </div>
              <div class="form-group" data-pickup-service-group>
                <label for="heroPickupDelivery" class="form-label">Busca e entrega do pet</label>
                <select id="heroPickupDelivery" name="pickup_delivery" class="form-control-custom" data-pickup-delivery>
                  <option value="nao">Não preciso — vou levar o pet</option>
                  <option value="sim">Sim, preciso de busca e devolução</option>
                </select>
              </div>
              <div class="form-group" data-pickup-address-group hidden>
                <label for="heroPickupAddress" class="form-label">Endereço para buscar e devolver o pet</label>
                <input type="text" id="heroPickupAddress" name="pickup_address" class="form-control-custom"
                       placeholder="Rua, número, bairro e cidade" autocomplete="street-address" data-pickup-address disabled>
              </div>
              <button type="submit" class="btn-submit" id="btnSubmitHero">
                <span>Vamos lá</span>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                  <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
              </button>
              <div class="form-note">
                🔒 Seus dados serão enviados para registro da solicitação de atendimento.
              </div>
            </form>
            <div id="heroSuccessAlert" class="success-alert" role="alert">
              <div class="success-alert-row">
                <span class="success-alert-emoji" aria-hidden="true">🎉</span>
                <div>
                  <strong class="success-alert-title">Solicitação recebida</strong>
                  <p id="successAlertMessage" class="success-alert-text">Sua solicitação poderá ser registrada após o envio do formulário.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Números de confiança -->
  <section class="stats-strip" aria-label="Números da Malu AuAu">
    <div class="stats-container">
      <div class="stat-item">
        <div class="stat-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
        </div>
        <div>
          <div class="stat-number">+8.500</div>
          <div class="stat-label">Pets atendidos</div>
        </div>
      </div>
      <div class="stat-item">
        <div class="stat-icon stat-icon--gold">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
        </div>
        <div>
          <div class="stat-number">4.9 / 5.0</div>
          <div class="stat-label">Avaliação média</div>
        </div>
      </div>
      <div class="stat-item">
        <div class="stat-icon stat-icon--rose">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
        </div>
        <div>
          <div class="stat-number">100% Amor</div>
          <div class="stat-label">Livre de estresse</div>
        </div>
      </div>
      <div class="stat-item">
        <div class="stat-icon stat-icon--indigo">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        </div>
        <div>
          <div class="stat-number">24 Horas</div>
          <div class="stat-label">Plantão médico</div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3) Serviços -->
  <section class="shell-section services-section" id="servicos">
    <div class="shell-container">
      <div class="section-title-wrap">
        <span class="section-tag">Serviços Especializados</span>
        <h2 class="section-heading">Tudo o que seu companheiro merece</h2>
        <p class="section-subheading">Ambientes climatizados, equipamentos modernos e profissionais apaixonados pelo bem-estar animal.</p>
      </div>
      <div class="services-grid">
        <div class="service-card">
          <div class="service-icon-box icon-teal">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 6 6.5 3.5a1.5 1.5 0 0 0-2.12 0l-.88.88a1.5 1.5 0 0 0 0 2.12L6 9"></path>
              <path d="m14 11 3.5 3.5a1.5 1.5 0 0 0 2.12 0l.88-.88a1.5 1.5 0 0 0 0-2.12L17 8"></path>
              <rect x="7" y="7" width="10" height="10" rx="3"></rect>
              <circle cx="12" cy="12" r="1"></circle>
            </svg>
          </div>
          <h3 class="service-title">Banho e Tosa</h3>
          <p class="service-text">
            Higienização com produtos hipoalergênicos, hidratação profunda, tosa na tesoura ou máquina e água na temperatura ideal.
          </p>
          <ul class="service-features">
            <li><span class="feature-check">✓</span> Hidratação de pelagem</li>
            <li><span class="feature-check">✓</span> Corte de unhas e limpeza de orelhas</li>
            <li><span class="feature-check">✓</span> Ambiente acústico calmo</li>
          </ul>
          <button type="button" class="service-btn" data-action="prefill-service" data-service="banho_tosa">Agendar Banho</button>
        </div>

        <div class="service-card">
          <div class="service-icon-box icon-pink">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 21a9 9 0 0 0 9-9c0-4.97-4.03-9-9-9s-9 4.03-9 9a9 9 0 0 0 9 9z"></path>
              <path d="M12 8v8"></path>
              <path d="M8 12h8"></path>
            </svg>
          </div>
          <h3 class="service-title">Consulta Veterinária</h3>
          <p class="service-text">
            Check-ups preventivos, vacinação importada, exames laboratoriais rápidos e acompanhamento integral da saúde do seu pet.
          </p>
          <ul class="service-features">
            <li><span class="feature-check">✓</span> Clínicos gerais e especialistas</li>
            <li><span class="feature-check">✓</span> Carteira de vacinação digital</li>
            <li><span class="feature-check">✓</span> Atendimento emergencial</li>
          </ul>
          <button type="button" class="service-btn" data-action="prefill-service" data-service="consulta">Marcar Consulta</button>
        </div>

        <div class="service-card">
          <div class="service-icon-box icon-yellow">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
              <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
          </div>
          <h3 class="service-title">Hospedagem &amp; Day Care</h3>
          <p class="service-text">
            Um verdadeiro resort pet! Quartos individuais aconchegantes, brincadeiras monitoradas, gramado ao ar livre e rotina com câmeras.
          </p>
          <ul class="service-features">
            <li><span class="feature-check">✓</span> Câmeras ao vivo para os tutores</li>
            <li><span class="feature-check">✓</span> Socialização segura por porte</li>
            <li><span class="feature-check">✓</span> Monitoramento 24h</li>
          </ul>
          <button type="button" class="service-btn" data-action="prefill-service" data-service="hospedagem">Reservar Diária</button>
        </div>

        <div class="service-card highlight">
          <span class="service-badge">Mais Econômico</span>
          <div class="service-icon-box icon-indigo">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
          </div>
          <h3 class="service-title">Plano AuAu</h3>
          <p class="service-text">
            Clube de assinatura de saúde e estética. Economize até 40% em consultas, banhos ilimitados com desconto e vacinas inclusas.
          </p>
          <ul class="service-features">
            <li><span class="feature-check">✓</span> Banhos mensais programados</li>
            <li><span class="feature-check">✓</span> Descontos em hotel e exames</li>
            <li><span class="feature-check">✓</span> Teleorientação veterinária</li>
          </ul>
          <a href="#planos" class="service-btn service-btn--amber">Ver Planos AuAu</a>
        </div>
      </div>
    </div>
  </section>

  <!-- 4) Planos -->
  <section class="plans-section" id="planos">
    <div class="shell-container">
      <div class="section-title-wrap">
        <span class="section-tag section-tag--amber">Planos de Cuidados</span>
        <h2 class="section-heading">Escolha o Plano AuAu Perfeito</h2>
        <p class="section-subheading">Proteção contínua, previsibilidade financeira e a certeza de que seu pet terá atendimento sempre que precisar.</p>
      </div>
      <div class="plans-grid">
        <div class="plan-card">
          <h3 class="plan-name">AuAu Leve</h3>
          <p class="plan-desc">Ideal para pets jovens que precisam de cuidados preventivos e banhos regulares.</p>
          <div class="plan-price-wrap">
            <div class="plan-price"><span class="plan-currency">R$</span> 79<span class="plan-cents">,90</span></div>
            <span class="plan-period">por mês / pet</span>
          </div>
          <ul class="plan-list">
            <li><span class="plan-check">✓</span> 1 Consulta veterinária semestral</li>
            <li><span class="plan-check">✓</span> Vacinas anuais obrigatórias inclusas</li>
            <li><span class="plan-check">✓</span> 2 Banhos mensais inclusos</li>
            <li><span class="plan-check">✓</span> 10% OFF em hospedagem e tosa</li>
            <li><span class="plan-check">✓</span> Carteira digital de vacinação</li>
          </ul>
          <button type="button" class="btn-cta btn-cta--dark" data-action="open-modal" data-service="plano_leve">Contratar AuAu Leve</button>
        </div>

        <div class="plan-card featured">
          <span class="plan-badge-top">O Mais Escolhido</span>
          <h3 class="plan-name">AuAu Conforto</h3>
          <p class="plan-desc">Cobertura robusta para tranquilidade total da família com assistência estendida.</p>
          <div class="plan-price-wrap">
            <div class="plan-price plan-price--teal"><span class="plan-currency">R$</span> 139<span class="plan-cents">,90</span></div>
            <span class="plan-period">por mês / pet</span>
          </div>
          <ul class="plan-list">
            <li><span class="plan-check">✓</span> <strong>Consultas veterinárias ilimitadas</strong></li>
            <li><span class="plan-check">✓</span> Pacote vacinal completo anual</li>
            <li><span class="plan-check">✓</span> 4 Banhos mensais com hidratação</li>
            <li><span class="plan-check">✓</span> 1 Tosa completa a cada 60 dias</li>
            <li><span class="plan-check">✓</span> 20% OFF em diárias de hotel</li>
            <li><span class="plan-check">✓</span> Plantão emergencial sem coparticipação</li>
          </ul>
          <button type="button" class="btn-cta" data-action="open-modal" data-service="plano_conforto">Contratar AuAu Conforto</button>
        </div>

        <div class="plan-card">
          <h3 class="plan-name">AuAu VIP Care</h3>
          <p class="plan-desc">A experiência máxima em comodidade com táxi pet e cobertura de exames complexos.</p>
          <div class="plan-price-wrap">
            <div class="plan-price"><span class="plan-currency">R$</span> 229<span class="plan-cents">,90</span></div>
            <span class="plan-period">por mês / pet</span>
          </div>
          <ul class="plan-list">
            <li><span class="plan-check">✓</span> Consultas gerais + Especialistas</li>
            <li><span class="plan-check">✓</span> Exames de sangue, ultrassom e raio-x</li>
            <li><span class="plan-check">✓</span> Banhos semanais + Tosa higiênica ilimitada</li>
            <li><span class="plan-check">✓</span> Leva &amp; Traz gratuito na região</li>
            <li><span class="plan-check">✓</span> 3 Diárias de hospedagem gratuitas/ano</li>
            <li><span class="plan-check">✓</span> Suporte veterinário 24h via WhatsApp</li>
          </ul>
          <button type="button" class="btn-cta btn-yellow" data-action="open-modal" data-service="plano_vip">Contratar AuAu VIP</button>
        </div>
      </div>
    </div>
  </section>

  <!-- 5) Sobre -->
  <section class="about-section" id="sobre">
    <div class="about-grid">
      <div class="about-image-wrap">
        <img class="about-main-img" src="{{ asset('img/ref-malu-about.svg') }}" alt="Ilustração da pug Malu recebendo cuidados carinhosos na clínica">
        <div class="about-floating-card">
          <div class="about-floating-icon" aria-hidden="true">🐶</div>
          <div>
            <div class="about-floating-title">A Inspiração Malu</div>
            <div class="about-floating-sub">Nossa pug cheia de energia</div>
          </div>
        </div>
      </div>
      <div class="about-content">
        <span class="section-tag">Nossa Essência</span>
        <h2 class="section-heading">Tudo começou com a Malu, nossa pug cheia de vida</h2>
        <p class="about-text-lead">
          A história da <strong>Malu AuAu</strong> começou com uma pug encantadora chamada <strong>Malu</strong>. Com suas dobrinhas expressivas, respiração que exigia atenção especial e uma energia alegre inesgotável, a Malu nos mostrou na prática que cada pet tem suas próprias particularidades.
        </p>
        <p class="about-text-body">
          Ao procurarmos atendimento sem estresse e banhos adequados para ela — sem gaiolas, sem temperaturas excessivas e com carinho genuíno —, percebemos a carência de um lugar verdadeiramente humanizado. Inspirados pela Malu, criamos um centro completo onde cães de todas as raças e gatinhos recebem cuidados personalizados, enriquecimento ambiental e o mesmo carinho que têm em casa.
        </p>
        <div class="about-pill-list">
          <div class="about-pill">
            <span class="about-pill-icon--teal" aria-hidden="true">🛡️</span>
            <span>Especialistas em Braquicefálicos</span>
          </div>
          <div class="about-pill">
            <span class="about-pill-icon--amber" aria-hidden="true">🍃</span>
            <span>Produtos Hipoalergênicos</span>
          </div>
          <div class="about-pill">
            <span class="about-pill-icon--teal" aria-hidden="true">📹</span>
            <span>Transparência por Câmeras</span>
          </div>
          <div class="about-pill">
            <span class="about-pill-icon--rose" aria-hidden="true">🐾</span>
            <span>Manejo Fear-Free (Sem Estresse)</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 6) Depoimentos -->
  <section class="testimonials-section" id="depoimentos">
    <div class="shell-container">
      <div class="section-title-wrap">
        <span class="section-tag section-tag--pink">Depoimentos Reais</span>
        <h2 class="section-heading">O que dizem os papais e mamães de pet</h2>
        <p class="section-subheading">Histórias de quem confia na Malu AuAu todos os dias.</p>
      </div>
      <div class="testimonials-grid">
        <div class="testimonial-card">
          <div class="test-stars">★★★★★</div>
          <p class="test-text">
            "O Bento sempre entrava em pânico para tomar banho em outros pet shops. Na Malu AuAu ele chega abanando o rabinho e entra correndo! O carinho dos profissionais é nítido."
          </p>
          <div class="test-author">
            <svg width="48" height="48" viewBox="0 0 48 48" class="author-avatar" aria-label="Camila Martins">
              <circle cx="24" cy="24" r="23" fill="#fef3c7" stroke="#d97706" stroke-width="2"/>
              <circle cx="24" cy="18" r="8" fill="#d97706"/>
              <path d="M12 38 C12 30 17 28 24 28 C31 28 36 30 36 38 Z" fill="#d97706"/>
            </svg>
            <div>
              <div class="author-name">Camila Martins</div>
              <div class="author-pet">Tutora do Bento (Golden Retriever)</div>
            </div>
          </div>
        </div>

        <div class="testimonial-card">
          <div class="test-stars">★★★★★</div>
          <p class="test-text">
            "Tenho um pug como a mascote Malu e sei bem o quanto as dobrinhas do focinho e a respiração exigem técnica e delicadeza. Na Malu AuAu o banho com secagem fresca e o plano preventivo são perfeitos. O Paçoca ama a equipe!"
          </p>
          <div class="test-author">
            <svg width="48" height="48" viewBox="0 0 48 48" class="author-avatar" aria-label="Rodrigo Toledo">
              <circle cx="24" cy="24" r="23" fill="#ccfbf1" stroke="#0d9488" stroke-width="2"/>
              <circle cx="24" cy="18" r="8" fill="#0d9488"/>
              <path d="M12 38 C12 30 17 28 24 28 C31 28 36 30 36 38 Z" fill="#0d9488"/>
            </svg>
            <div>
              <div class="author-name">Rodrigo Toledo</div>
              <div class="author-pet">Tutor do Paçoca (Pug)</div>
            </div>
          </div>
        </div>

        <div class="testimonial-card">
          <div class="test-stars">★★★★★</div>
          <p class="test-text">
            "Deixei meu gatinho hospedado por 10 dias nas férias. Recebia fotos e vídeos diários no Whats mostrando ele brincando e super à vontade. Segurança e amor sem igual!"
          </p>
          <div class="test-author">
            <svg width="48" height="48" viewBox="0 0 48 48" class="author-avatar" aria-label="Beatriz Vasconcelos">
              <circle cx="24" cy="24" r="23" fill="#ffe4e6" stroke="#e11d48" stroke-width="2"/>
              <circle cx="24" cy="18" r="8" fill="#e11d48"/>
              <path d="M12 38 C12 30 17 28 24 28 C31 28 36 30 36 38 Z" fill="#e11d48"/>
            </svg>
            <div>
              <div class="author-name">Beatriz Vasconcelos</div>
              <div class="author-pet">Tutora do Floquinho (Persa)</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Banner CTA intermediário -->
  <section class="cta-banner">
    <div class="cta-banner-inner">
      <h2 class="cta-banner-title">Seu pet merece esse carinho hoje mesmo!</h2>
      <p class="cta-banner-text">Dê o primeiro passo para conhecer nossos serviços e os cuidados preparados para seu pet.</p>
      <div class="cta-banner-actions">
        <button type="button" class="btn-cta btn-yellow" data-action="prefill-service" data-service="banho_tosa">
          🐾 Agendar Primeiro Banho
        </button>
        <button type="button" class="btn-cta btn-ghost" data-action="open-modal">
          💬 Solicitar contato
        </button>
      </div>
    </div>
  </section>

  <!-- 7) Rodapé -->
  <footer class="site-footer" id="contato">
    <div class="footer-container">
      <div class="footer-col">
        <div class="footer-logo">
          <div class="logo-badge footer-logo-badge" title="Malu a Pug">
            <img src="{{ asset('img/ref-malu-logo-footer.svg') }}" width="26" height="26" alt="" aria-hidden="true">
          </div>
          <span>Malu AuAu</span>
        </div>
        <p class="footer-about">
          Referência em saúde preventiva, bem-estar animal e amor incondicional para cães e gatos em todo o Brasil.
        </p>
        <h4>Redes sociais</h4>
        <div class="footer-socials" aria-label="Redes sociais da Malu AuAu">
          {{-- TODO: substituir pelos perfis oficiais antes de publicar --}}
          <a class="footer-social-link" href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" aria-label="Instagram da Malu AuAu">
            <img src="{{ asset('img/instagram.svg') }}" alt="" aria-hidden="true">
          </a>
          <a class="footer-social-link" href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" aria-label="Facebook da Malu AuAu">
            <img src="{{ asset('img/facebook.svg') }}" alt="" aria-hidden="true">
          </a>
          <a class="footer-social-link" href="https://www.tiktok.com/" target="_blank" rel="noopener noreferrer" aria-label="TikTok da Malu AuAu">
            <img src="{{ asset('img/tiktok.svg') }}" alt="" aria-hidden="true">
          </a>
        </div>
      </div>

      <div class="footer-col">
        <h4>Navegação</h4>
        <ul class="footer-links">
          <li><a href="#inicio">Início</a></li>
          <li><a href="#servicos">Serviços Especializados</a></li>
          <li><a href="#planos">Planos AuAu de Saúde</a></li>
          <li><a href="#sobre">Nossa História &amp; Valores</a></li>
          <li><a href="#depoimentos">Depoimentos dos Tutores</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Serviços</h4>
        <ul class="footer-links">
          <li><a href="#servicos" data-action="prefill-service" data-service="banho_tosa">Banho Terapêutico &amp; Tosa</a></li>
          <li><a href="#servicos" data-action="prefill-service" data-service="consulta">Consultas Clínicas 24h</a></li>
          <li><a href="#servicos" data-action="prefill-service" data-service="hospedagem">Hotel &amp; Day Care Pet</a></li>
          <li><a href="#planos">Vacinação e Preventivos</a></li>
          <li><a href="#planos">Transporte Pet Amigo</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Horários &amp; Local</h4>
        <div class="footer-contact">
          <p><strong>📍 Unidade Central:</strong><br>Av. dos Animais Felizes, 1020 — Jardim Pet, Goiânia - GO</p>
          <p><strong>⏰ Horário de Funcionamento:</strong><br>Segunda a Sábado: 07h30 às 20h00<br>Domingos e Feriados: 08h00 às 16h00<br><span class="footer-emergency">Emergência Veterinária: 24h</span></p>
          <p><strong>📞 Central de Atendimento:</strong><br>
            {{-- TODO: confirmar o telefone real antes de publicar --}}
            <a class="footer-contact-link" href="tel:+5562988887777">(62) 98888-7777</a>
          </p>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div>
        &copy; <span id="currentYear"></span> Malu AuAu Serviços Pet Ltda. Todos os direitos reservados.
        {{-- TODO: substituir pelo CNPJ real --}}
        CNPJ: 12.345.678/0001-90
      </div>
      <div class="footer-bottom-links">
        {{-- TODO: apontar para as páginas reais de Termos e Privacidade --}}
        <a href="#privacidade" class="footer-legal-link">Termos de Uso</a>
        <a href="#privacidade" class="footer-legal-link">Política de Privacidade</a>
      </div>
    </div>
  </footer>

  <!-- 8) Barra de cookies (LGPD: aceitar ou recusar) -->
  <aside class="cookie-bar" id="cookieBar" role="region" aria-label="Aviso de Privacidade e Cookies">
    <div class="cookie-bar-content">
      <span class="cookie-bar-icon" aria-hidden="true">🍪</span>
      <p class="cookie-text">
        Utilizamos cookies e tecnologias similares para melhorar sua experiência, garantir a segurança do seu pet e personalizar nossos serviços. Você pode aceitar ou recusar.
      </p>
    </div>
    <div class="cookie-bar-actions">
      <button type="button" class="btn-cta btn-ghost" id="btnRejectCookies">Recusar</button>
      <button type="button" class="btn-cta btn-accept" id="btnAcceptCookies">Aceitar</button>
    </div>
  </aside>

  <!-- 9) Modal de agendamento rápido -->
  <div class="modal-overlay" id="scheduleModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-box">
      <button type="button" class="modal-close" data-action="close-modal" aria-label="Fechar janela">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
      </button>
      <div class="modal-title-row">
        <span aria-hidden="true">🐾</span>
        <h3 id="modalTitle" class="modal-title">Agende com a Malu AuAu</h3>
      </div>
      <p class="modal-intro">
        Preencha seus dados para registrar uma solicitação. A equipe poderá entrar em contato para confirmar os detalhes.
      </p>
      <form id="modalForm" action="{{ route('agendamentos.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="modalTutorName" class="form-label">Seu nome (Tutor)</label>
          <input type="text" id="modalTutorName" name="tutor_name" class="form-control-custom" placeholder="Ex: Maria Oliveira" required>
        </div>
        <div class="form-group">
          <label for="modalPhone" class="form-label">WhatsApp com DDD</label>
          <input type="tel" id="modalPhone" name="phone" class="form-control-custom js-phone" placeholder="(62) 9XXXX-XXXX" inputmode="numeric" autocomplete="tel" maxlength="15" required>
        </div>
        <div class="form-group">
          <label for="modalPetName" class="form-label">Nome do Pet</label>
          <input type="text" id="modalPetName" name="pet_name" class="form-control-custom" placeholder="Ex: Bob" required>
        </div>
        <div class="form-group">
          <label for="modalPetType" class="form-label">Tipo de pet</label>
          <select id="modalPetType" name="pet_type" class="form-control-custom">
            <option value="cachorro">🐶 Cãozinho</option>
            <option value="gato">🐱 Gatinho</option>
            <option value="outro">🐰 Outro Pet</option>
          </select>
        </div>
        <div class="form-group">
          <label for="modalServiceSelect" class="form-label">Serviço de preferência</label>
          <select id="modalServiceSelect" name="service" class="form-control-custom">
            <option value="banho_tosa">Banho e Tosa</option>
            <option value="consulta">Consulta Veterinária</option>
            <option value="hospedagem">Hospedagem &amp; Day Care</option>
            <option value="plano_conforto">Plano AuAu Conforto (Mais Procurado)</option>
            <option value="plano_leve">Plano AuAu Leve</option>
            <option value="plano_vip">Plano AuAu VIP Care</option>
          </select>
        </div>
        <div class="form-group" data-pickup-service-group>
          <label for="modalPickupDelivery" class="form-label">Busca e entrega do pet</label>
          <select id="modalPickupDelivery" name="pickup_delivery" class="form-control-custom" data-pickup-delivery>
            <option value="nao">Não preciso — vou levar o pet</option>
            <option value="sim">Sim, preciso de busca e devolução</option>
          </select>
        </div>
        <div class="form-group" data-pickup-address-group hidden>
          <label for="modalPickupAddress" class="form-label">Endereço para buscar e devolver o pet</label>
          <input type="text" id="modalPickupAddress" name="pickup_address" class="form-control-custom"
                 placeholder="Rua, número, bairro e cidade" autocomplete="street-address" data-pickup-address disabled>
        </div>
        <button type="submit" class="btn-submit btn-submit--modal">
          Confirmar Agendamento
        </button>
      </form>
      <div id="modalSuccessMsg" class="success-alert">
        <strong class="success-alert-title">Solicitação enviada</strong>
        <span class="success-alert-text">Sua solicitação foi registrada. O agendamento só estará confirmado após contato da equipe.</span>
      </div>
    </div>
  </div>

</body>
</html>