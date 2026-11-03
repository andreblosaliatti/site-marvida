# MV Safety — GitHub Pages

Site institucional estático bilíngue. Não requer WordPress, Polylang, banco de dados nem PHP no servidor publicado. Um GitHub Actions workflow usa PHP somente durante o build para gerar arquivos HTML estáticos a partir dos conteúdos em `inc/content.php`; estilos, scripts e imagens vêm de `assets/`.

## Ativar a publicação

1. Envie a branch `main` e os arquivos do repositório ao GitHub.
2. No GitHub, abra **Settings > Pages** e, em **Build and deployment**, selecione **GitHub Actions** como origem. O workflow `.github/workflows/pages.yml` gera e publica o site ao receber atualizações em `main`.
3. Confira a execução em **Actions > Deploy MV Safety to GitHub Pages**. Após o deploy, a etapa de publicação mostra a URL.
4. O build detecta automaticamente sites de usuário/organização (`owner.github.io`) e sites de projeto (`owner.github.io/repository`). Para domínio próprio, configure o domínio em **Settings > Pages** e crie as variáveis opcionais abaixo.

### Variáveis opcionais do repositório

Em **Settings > Secrets and variables > Actions > Variables**, cadastre:

- `MVSAFETY_SITE_URL`: origem pública HTTPS, sem `/` final nem caminho, por exemplo `https://www.seudominio.com.br`. Ao usar domínio próprio, cadastre também o domínio em **Settings > Pages**.
- `MVSAFETY_BASE_PATH`: prefixo opcional do site, sem barras externas. Deixe-o ausente/vazio para domínio próprio na raiz; em site de projeto, o nome do repositório é detectado automaticamente quando `MVSAFETY_SITE_URL` não foi definido.
- `MVSAFETY_FORM_ENDPOINT`: endpoint HTTPS de um provedor de formulários que aceita `multipart/form-data`, solicitações do navegador com CORS e a origem deste site. Opcional; sem essa variável, o formulário aparece desativado com um aviso, em vez de aparentar que enviou uma solicitação.

Um formulário estático não pode enviar e-mail por PHP/SMTP. Antes de cadastrar um endpoint, escolha e configure um serviço de formulários, confirme para onde os dados serão encaminhados e atualize a política de privacidade. O site não envia informações pessoais a terceiros até que um endpoint seja configurado. Não grave senhas SMTP nem chaves privadas em variáveis públicas ou no código do site.

## Conteúdo e URLs

- Português: `/pt/inicio/`, `/pt/empresa/`, `/pt/servicos/`, `/pt/combate-a-incendio/`, `/pt/balsas-salva-vidas/`, `/pt/botes-de-resgate/`, `/pt/certificacoes/`, `/pt/contato/`, `/pt/politica-de-privacidade/`.
- English: `/en/home/`, `/en/about/`, `/en/services/`, `/en/firefighting-equipment/`, `/en/liferafts/`, `/en/rescue-boats/`, `/en/certifications/`, `/en/contact/`, `/en/privacy-policy/`.
- O seletor PT | EN abre a página correspondente no idioma escolhido. O conteúdo é mantido em `inc/content.php`; cabeçalho, rodapé e lógica ficam em arquivos PHP no repositório, e não no servidor publicado.
- O build produz canonical, `hreflang`, dados estruturados, sitemap, `robots.txt`, página 404 e arquivos na pasta `dist/`. O workflow publica apenas `dist/`.
- A página de Privacidade é um rascunho informativo e requer revisão jurídica antes de ser publicada.
- Não há painel para editar conteúdo: faça alterações nos arquivos e envie-as à branch `main`.

## Pré-visualização e build local

Com PHP 8.2 ou superior:

```powershell
cd mvsafety
php -S 127.0.0.1:8000 router.php
```

Abra `http://127.0.0.1:8000/`. Para gerar os mesmos arquivos estáticos que o workflow publica:

```powershell
$env:GITHUB_REPOSITORY = "owner/repository"
php scripts/build-static.php
```

O resultado ficará em `dist/`. Configure `MVSAFETY_SITE_URL`, `MVSAFETY_BASE_PATH` e `MVSAFETY_FORM_ENDPOINT` no ambiente caso queira reproduzir as variáveis do GitHub Actions.
