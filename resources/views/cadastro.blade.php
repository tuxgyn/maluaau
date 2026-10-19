<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastre-se — Malu AuAu</title>
  <meta name="description" content="Crie seu cadastro na Malu AuAu e o do seu pet para agilizar banhos, consultas e hospedagem.">
  <link rel="icon" href="{{ asset('img/favicon.svg') }}" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/basecoat-css@1.0.2/dist/basecoat.cdn.min.css">
  <link rel="stylesheet" href="{{ asset('style/style.css') }}">
  {{-- APENAS o jscript.js. Nunca carregue o jscriptoriginal.js junto. --}}
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
      <strong>Não foi possível concluir o cadastro:</strong>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Header simplificado -->
  <header class="site-header" id="siteHeader">
    <div class="header-inner">
      <a href="{{ route('home') }}" class="logo-container" aria-label="Voltar para a página inicial da Malu AuAu">
        <div class="logo-badge" title="Malu a Pug">
          <img src="{{ asset('img/ref-malu-logo-header.svg') }}" width="32" height="32" alt="" aria-hidden="true">
        </div>
        <div>
          <span class="brand-name">Malu AuAu</span>
          <div class="brand-tag">Amor &amp; Saúde Pet</div>
        </div>
      </a>
      <div class="header-actions">
        <a href="{{ route('home') }}" class="btn-cta">← Voltar ao site</a>
      </div>
    </div>
  </header>

  <!-- Formulário de cadastro -->
  <section class="cadastro-section">
    <div class="cadastro-card">
      <span class="booking-card-ribbon">Novo por aqui?</span>
      <h1 class="booking-card-title">Cadastre-se na Malu AuAu</h1>
      <p class="booking-card-desc">
        Preencha seus dados e os do seu pet. É rapidinho — a equipe usa essas
        informações para preparar o seu atendimento.
      </p>

      <form id="userRegisterForm" action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        <div class="form-row">
          <div class="form-group">
            <label for="regNome" class="form-label">Nome *</label>
            <input type="text" id="regNome" name="nome" class="form-control-custom"
                   placeholder="Ex: Maria" autocomplete="given-name"
                   value="{{ old('nome') }}" required title="Preenchimento obrigatório.">
          </div>

          <div class="form-group">
            <label for="regSobrenome" class="form-label">Sobrenome *</label>
            <input type="text" id="regSobrenome" name="sobrenome" class="form-control-custom"
                   placeholder="Ex: Oliveira" autocomplete="family-name"
                   value="{{ old('sobrenome') }}" required title="Preenchimento obrigatório.">
          </div>
        </div>

        <div class="form-group">
          <label for="regEmail" class="form-label">E-mail *</label>
          <input type="email" id="regEmail" name="email" class="form-control-custom"
                 placeholder="Ex: maria@email.com" autocomplete="email"
                 value="{{ old('email') }}" required title="Informe um e-mail válido.">
        </div>

        <div class="form-group">
          <label for="regTelefone" class="form-label">Telefone (WhatsApp) *</label>
          <input type="tel" id="regTelefone" name="telefone" class="form-control-custom js-phone"
                 placeholder="(62) 9XXXX-XXXX" inputmode="numeric" autocomplete="tel"
                 maxlength="15" value="{{ old('telefone') }}" required title="Preenchimento obrigatório.">
        </div>

        <!-- CAMPO: CEP (Movido para antes do Endereço) -->
        <div class="form-group">
          <label for="regCep" class="form-label">CEP *</label>
          <input type="text" id="regCep" name="cep" class="form-control-custom"
                 placeholder="Ex: 74000-000"
                 inputmode="numeric" autocomplete="postal-code"
                 maxlength="9" pattern="[0-9]{5}-?[0-9]{3}"
                 value="{{ old('cep') }}" required title="Informe um CEP válido com 8 dígitos.">
        </div>

        <div class="form-row">
          <div class="form-group" style="flex: 3;">
            <label for="regEndereco" class="form-label">Endereço *</label>
            <input type="text" id="regEndereco" name="endereco" class="form-control-custom"
                   placeholder="Ex: Rua das Flores"
                   autocomplete="street-address" value="{{ old('endereco') }}" required title="Preenchimento obrigatório.">
          </div>

          <!-- CAMPO: Número -->
          <div class="form-group" style="flex: 1;">
            <label for="regNumero" class="form-label">Número *</label>
            <input type="text" id="regNumero" name="numero" class="form-control-custom"
                   placeholder="Ex: 123"
                   autocomplete="address-line2" value="{{ old('numero') }}" required title="Preenchimento obrigatório.">
          </div>
        </div>

        <!-- CAMPO: Cidade -->
        <div class="form-group">
          <label for="regCidade" class="form-label">Cidade *</label>
          <input type="text" id="regCidade" name="cidade" class="form-control-custom"
                 placeholder="Ex: Goiânia"
                 autocomplete="address-level2"
                 value="{{ old('cidade') }}" required title="Preenchimento obrigatório.">
        </div>

        <!-- CAMPO: Estado -->
        <div class="form-group">
          <label for="regEstado" class="form-label">Estado (UF) *</label>
          <select id="regEstado" name="estado" class="form-control-custom" required title="Selecione um estado obrigatório.">
            <option value="">Selecione o estado</option>
            @foreach ([
              'AC' => 'Acre',
              'AL' => 'Alagoas',
              'AP' => 'Amapá',
              'AM' => 'Amazonas',
              'BA' => 'Bahia',
              'CE' => 'Ceará',
              'DF' => 'Distrito Federal',
              'ES' => 'Espírito Santo',
              'GO' => 'Goiás',
              'MA' => 'Maranhão',
              'MT' => 'Mato Grosso',
              'MS' => 'Mato Grosso do Sul',
              'MG' => 'Minas Gerais',
              'PA' => 'Pará',
              'PB' => 'Paraíba',
              'PR' => 'Paraná',
              'PE' => 'Pernambuco',
              'PI' => 'Piauí',
              'RJ' => 'Rio de Janeiro',
              'RN' => 'Rio Grande do Norte',
              'RS' => 'Rio Grande do Sul',
              'RO' => 'Rondônia',
              'RR' => 'Roraima',
              'SC' => 'Santa Catarina',
              'SP' => 'São Paulo',
              'SE' => 'Sergipe',
              'TO' => 'Tocantins',
            ] as $uf => $nomeEstado)
              <option value="{{ $uf }}" @selected(old('estado') === $uf)>
                {{ $nomeEstado }} ({{ $uf }})
              </option>
            @endforeach
          </select>
        </div>

        <!-- CAMPO: Bairro -->
        <div class="form-group">
          <label for="regBairro" class="form-label">Bairro *</label>
          <input type="text" id="regBairro" name="bairro" class="form-control-custom"
                 placeholder="Ex: Setor Bueno"
                 autocomplete="address-level3"
                 value="{{ old('bairro') }}" required title="Preenchimento obrigatório.">
        </div>

        <!-- CAMPO: Nome do pet -->
        <div class="form-group">
          <label for="regPetNome" class="form-label">Nome do pet *</label>
          <input type="text" id="regPetNome" name="pet_nome" class="form-control-custom"
                 placeholder="Ex: Bob" value="{{ old('pet_nome') }}" required title="Preenchimento obrigatório.">
        </div>

        <!-- CAMPO: Raça do pet -->
        <div class="form-group">
          <label for="regPetRaca" class="form-label">Raça do pet *</label>
          <input type="text" id="regPetRaca" name="pet_raca" class="form-control-custom"
                 placeholder="Ex: Pug, Shih-tzu, Labrador ou SRD"
                 value="{{ old('pet_raca') }}" required title="Preenchimento obrigatório.">
        </div>

        <button type="submit" class="btn-submit">Criar meu cadastro</button>

        <div class="form-note">
          🔒 Seus dados serão usados apenas para o atendimento do seu pet.
        </div>
      </form>
    </div>
  </section>

  <!-- Rodapé simplificado -->
  <footer class="site-footer">
    <div class="footer-container footer-container--simple">
      <div class="footer-col">
        <div class="footer-logo">
          <div class="logo-badge footer-logo-badge" title="Malu a Pug">
            <img src="{{ asset('img/ref-malu-logo-footer.svg') }}" width="26" height="26" alt="" aria-hidden="true">
          </div>
          <span>Malu AuAu</span>
        </div>
        <p class="footer-about">
          Amor &amp; saúde pet — banho e tosa, consultas, hospedagem e planos de cuidados.
        </p>
      </div>

      <div class="footer-col">
        <h4>Precisa de ajuda?</h4>
        <ul class="footer-links">
          <li><a href="{{ route('home') }}">Voltar para a página inicial</a></li>
          <li><a href="{{ route('home') }}#contato">Contato e horários</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <div>
        &copy; <span id="currentYear"></span> Malu AuAu Serviços Pet Ltda. Todos os direitos reservados.
      </div>
    </div>
  </footer>

</body>
</html>