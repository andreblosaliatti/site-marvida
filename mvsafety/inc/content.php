<?php
/**
 * Initial page metadata and bilingual website copy.
 */

if ( ! defined( 'MVSAFETY_SITE' ) ) {
	exit;
}

function mvsafety_page_definitions(): array {
	return array(
		'home'           => array(
			'pt' => array(
				'title'       => 'Início',
				'slug'        => 'inicio',
				'seo_title'   => 'MV Safety | Segurança Marítima e Salvatagem',
				'description' => 'Desde 2001, a MV Safety oferece serviços de inspeção, manutenção e certificação de equipamentos de segurança marítima em Paranaguá (PR).',
			),
			'en' => array(
				'title'       => 'Home',
				'slug'        => 'home',
				'seo_title'   => 'MV Safety | Maritime Safety and Lifesaving',
				'description' => 'Since 2001, MV Safety has provided inspection, maintenance and certification services for maritime safety equipment in Paranaguá, Brazil.',
			),
		),
		'company'        => array(
			'pt' => array(
				'title'       => 'A Empresa',
				'slug'        => 'empresa',
				'seo_title'   => 'A Empresa | MV Safety',
				'description' => 'Conheça a MV Safety, especialista em segurança marítima, proteção contra incêndio e salvatagem desde 2001.',
			),
			'en' => array(
				'title'       => 'About Us',
				'slug'        => 'about',
				'seo_title'   => 'About Us | MV Safety',
				'description' => 'Meet MV Safety, a maritime safety, firefighting and lifesaving specialist since 2001.',
			),
		),
		'services'       => array(
			'pt' => array(
				'title'       => 'Serviços',
				'slug'        => 'servicos',
				'seo_title'   => 'Serviços de Segurança Marítima | MV Safety',
				'description' => 'Inspeção e manutenção de equipamentos de combate a incêndio, balsas salva-vidas e botes de resgate.',
			),
			'en' => array(
				'title'       => 'Services',
				'slug'        => 'services',
				'seo_title'   => 'Maritime Safety Services | MV Safety',
				'description' => 'Inspection and maintenance of firefighting equipment, liferafts and rescue boats.',
			),
		),
		'firefighting'   => array(
			'pt' => array(
				'title'       => 'Combate a Incêndio',
				'slug'        => 'combate-a-incendio',
				'seo_title'   => 'Combate a Incêndio | MV Safety',
				'description' => 'Serviços de inspeção, manutenção e recarga de sistemas e equipamentos de combate a incêndio a bordo.',
			),
			'en' => array(
				'title'       => 'Firefighting Equipment',
				'slug'        => 'firefighting-equipment',
				'seo_title'   => 'Firefighting Equipment | MV Safety',
				'description' => 'Inspection, maintenance and recharging services for onboard firefighting systems and equipment.',
			),
		),
		'liferafts'       => array(
			'pt' => array(
				'title'       => 'Balsas Salva-vidas',
				'slug'        => 'balsas-salva-vidas',
				'seo_title'   => 'Balsas Salva-vidas | MV Safety',
				'description' => 'Inspeção e manutenção de balsas salva-vidas com atenção às condições de segurança e funcionamento.',
			),
			'en' => array(
				'title'       => 'Liferafts',
				'slug'        => 'liferafts',
				'seo_title'   => 'Liferaft Inspection and Maintenance | MV Safety',
				'description' => 'Liferaft inspection and maintenance focused on safety and equipment readiness.',
			),
		),
		'rescue_boats'   => array(
			'pt' => array(
				'title'       => 'Botes de Resgate',
				'slug'        => 'botes-de-resgate',
				'seo_title'   => 'Botes de Resgate | MV Safety',
				'description' => 'Revisão e certificação de baleeiras, botes de resgate e sistemas de lançamento.',
			),
			'en' => array(
				'title'       => 'Rescue Boats',
				'slug'        => 'rescue-boats',
				'seo_title'   => 'Rescue Boats and Lifeboats | MV Safety',
				'description' => 'Inspection and certification of lifeboats, rescue boats and launching appliances.',
			),
		),
		'certifications' => array(
			'pt' => array(
				'title'       => 'Certificações',
				'slug'        => 'certificacoes',
				'seo_title'   => 'Certificações Internacionais | MV Safety',
				'description' => 'Informações sobre conformidade e certificações da MV Safety, sujeitas à validação documental.',
			),
			'en' => array(
				'title'       => 'Certifications',
				'slug'        => 'certifications',
				'seo_title'   => 'International Certifications | MV Safety',
				'description' => 'Information about MV Safety compliance and certifications, subject to documentary verification.',
			),
		),
		'contact'        => array(
			'pt' => array(
				'title'       => 'Contato',
				'slug'        => 'contato',
				'seo_title'   => 'Contato | MV Safety',
				'description' => 'Fale com a equipe MV Safety e solicite atendimento especializado em segurança marítima.',
			),
			'en' => array(
				'title'       => 'Contact',
				'slug'        => 'contact',
				'seo_title'   => 'Contact | MV Safety',
				'description' => 'Contact the MV Safety team to request specialist maritime safety support.',
			),
		),
		'privacy'        => array(
			'pt' => array(
				'title'       => 'Política de Privacidade',
				'slug'        => 'politica-de-privacidade',
				'seo_title'   => 'Política de Privacidade | MV Safety',
				'description' => 'Saiba como as informações enviadas à MV Safety por este site devem ser tratadas.',
			),
			'en' => array(
				'title'       => 'Privacy Policy',
				'slug'        => 'privacy-policy',
				'seo_title'   => 'Privacy Policy | MV Safety',
				'description' => 'Learn how information submitted to MV Safety through this website should be handled.',
			),
		),
	);
}

function mvsafety_page_content( string $key, string $language ): string {
	$english = 'en' === $language;

	$content = array(
		'pt' => array(
			'home' => <<<'HTML'
<section class="mv-hero">
	<img class="mv-hero__image" src="{{asset:images/hero/hero-conceito-IA-ampliado-1920.jpg}}" alt="Imagem conceitual ilustrativa de uma balsa salva-vidas no mar" fetchpriority="high" decoding="async">
	<div class="mv-hero__shade"></div>
	<div class="mv-hero__content">
		<p class="mv-eyebrow">Segurança para operações marítimas</p>
		<h1>SEGURANÇA <span>MARÍTIMA</span> GLOBAL</h1>
		<p>Protegendo vidas, cargas e o seu patrimônio.</p>
		<small>Imagem conceitual ilustrativa.</small>
	</div>
</section>
<section class="mv-section mv-about-preview">
	<div class="mv-container mv-two-column">
		<div><p class="mv-eyebrow">Tradição, técnica e compromisso</p><h2>Especialistas em proteção contra incêndio e salvatagem</h2>
			<p>Desde 2001, a MV Safety atua no setor de engenharia de segurança marítima, oferecendo soluções especializadas para embarcações nacionais e internacionais.</p>
			<p>Localizada estrategicamente em Paranaguá (PR), um dos principais polos portuários da América Latina, a empresa reúne experiência técnica, agilidade e compromisso com os padrões internacionais de segurança.</p>
			<p>Nosso trabalho contribui para a proteção de vidas, cargas e patrimônio, por meio de serviços de inspeção, manutenção e certificação de equipamentos essenciais à segurança a bordo.</p>
			<a class="mv-text-link" href="{{page:company}}">Conheça a MV Safety <span aria-hidden="true">→</span></a>
		</div><div class="mv-about-mark" aria-hidden="true"><span>MV</span><strong>SAFETY</strong><small>PARANAGUÁ · BRASIL</small></div>
	</div>
</section>
<section class="mv-section mv-section--soft">
	<div class="mv-container"><div class="mv-section-heading"><p class="mv-eyebrow">Nossos serviços</p><h2>Soluções completas em segurança marítima</h2><p>Serviços especializados de inspeção, manutenção e certificação de equipamentos de segurança, com foco na proteção da tripulação e na conformidade operacional das embarcações.</p></div>
		<div class="mv-service-grid">
			<article class="mv-card"><img src="{{asset:images/services/servico-combate-incendio-ilustrativo.jpg}}" alt="Imagem ilustrativa de equipamento de combate a incêndio" loading="lazy" decoding="async"><div class="mv-card__body"><img class="mv-icon" src="{{asset:icons/icone-incendio.svg}}" alt="" loading="lazy"><h3>Combate a Incêndio</h3><p>Manutenção, inspeção e recarga de sistemas e equipamentos de combate a incêndio a bordo, contribuindo para sua confiabilidade e prontidão em situações de emergência.</p><a class="mv-text-link" href="{{page:firefighting}}">Saiba mais <span aria-hidden="true">→</span></a></div></article>
			<article class="mv-card"><img src="{{asset:images/services/servico-balsas-salva-vidas.webp}}" alt="Balsas salva-vidas nas instalações da MV Safety" loading="lazy" decoding="async"><div class="mv-card__body"><img class="mv-icon" src="{{asset:icons/icone-balsa.svg}}" alt="" loading="lazy"><h3>Balsas Salva-vidas</h3><p>Inspeção e manutenção completa de balsas salva-vidas, seguindo os procedimentos técnicos aplicáveis para preservar as condições de segurança e funcionamento dos equipamentos.</p><a class="mv-text-link" href="{{page:liferafts}}">Saiba mais <span aria-hidden="true">→</span></a></div></article>
			<article class="mv-card"><img src="{{asset:images/services/servico-bote-resgate-ilustrativo.jpg}}" alt="Imagem ilustrativa de bote de resgate" loading="lazy" decoding="async"><div class="mv-card__body"><img class="mv-icon" src="{{asset:icons/icone-bote.svg}}" alt="" loading="lazy"><h3>Botes de Resgate</h3><p>Revisão e certificação de baleeiras, botes de resgate e sistemas de lançamento (turcos), visando à segurança e confiabilidade das operações de emergência.</p><a class="mv-text-link" href="{{page:rescue_boats}}">Saiba mais <span aria-hidden="true">→</span></a></div></article>
		</div>
	</div>
</section>
<section class="mv-section">
	<div class="mv-container mv-cert-preview"><div><p class="mv-eyebrow">Conformidade e qualidade</p><h2>Certificações Internacionais</h2><p>A segurança marítima exige rigor técnico, procedimentos confiáveis e conformidade com os padrões internacionais.</p><p>A MV Safety desenvolve seus serviços com foco nessas exigências, buscando assegurar qualidade e confiança em cada operação.</p><a class="mv-text-link" href="{{page:certifications}}">Consulte as informações <span aria-hidden="true">→</span></a></div><p class="mv-document-note">Informações sobre sociedades classificadoras e homologações estão sujeitas à confirmação documental.</p></div>
</section>
<section class="mv-section mv-section--soft">
	<div class="mv-container"><div class="mv-section-heading"><p class="mv-eyebrow">Nossos diferenciais</p><h2>Por que escolher a MV Safety?</h2></div><div class="mv-feature-grid">
		<article><img class="mv-icon" src="{{asset:icons/icone-trofeu.svg}}" alt="" loading="lazy"><h3>Experiência Consolidada</h3><p>Mais de duas décadas de atuação no mercado marítimo, oferecendo soluções técnicas voltadas à segurança das embarcações.</p></article>
		<article><img class="mv-icon" src="{{asset:icons/icone-localizacao.svg}}" alt="" loading="lazy"><h3>Localização Estratégica</h3><p>Sediada em Paranaguá (PR), com localização privilegiada para atender às demandas portuárias e operações em todo o território nacional.</p></article>
		<article><img class="mv-icon" src="{{asset:icons/icone-equipe.svg}}" alt="" loading="lazy"><h3>Equipe Técnica Qualificada</h3><p>Profissionais treinados para atender às exigências de segurança da Organização Marítima Internacional (IMO) e da autoridade marítima brasileira.</p></article>
		<article><img class="mv-icon" src="{{asset:icons/icone-relogio-24h.svg}}" alt="" loading="lazy"><h3>Atendimento 24 Horas</h3><p>Disponibilidade para atender às necessidades operacionais e situações emergenciais do setor marítimo.</p></article>
	</div></div>
</section>
<section class="mv-facility-band"><div class="mv-facility-band__copy"><p class="mv-eyebrow">Estrutura e capacidade técnica</p><h2>Nossa Estrutura</h2><p>Localizada em Paranaguá (PR), a MV Safety conta com instalações dedicadas aos serviços de segurança marítima, incluindo atividades de inspeção e manutenção de equipamentos de salvatagem.</p><p>Nossa estrutura e experiência técnica permitem atender às necessidades de embarcações nacionais e internacionais, com organização, precisão e compromisso com a segurança.</p><a class="mv-button mv-button--light" href="{{page:company}}#instalacoes">Conheça nossa estrutura</a></div><img src="{{asset:images/facilities/estrutura-oficina-balsas.webp}}" alt="Balsas salva-vidas nas instalações da MV Safety" loading="lazy" decoding="async"></section>
<section class="mv-section mv-contact-cta"><div class="mv-container"><p class="mv-eyebrow">Fale com a MV Safety</p><h2>Segurança para sua embarcação.<br>Confiança para sua operação.</h2><p>Precisa de inspeção, manutenção ou certificação de equipamentos de segurança marítima?</p><p>Entre em contato com nossa equipe e solicite um atendimento especializado.</p><a class="mv-button" href="{{page:contact}}">Solicitar Orçamento</a></div></section>
HTML,
			'company' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Tradição, técnica e compromisso</p><h1>A Empresa</h1><p>Segurança marítima, proteção contra incêndio e salvatagem desde 2001.</p></div></div>
<section class="mv-section"><div class="mv-container mv-prose"><h2>Especialistas em segurança marítima</h2><p>Desde 2001, a MV Safety atua no setor de engenharia de segurança marítima, oferecendo soluções especializadas para embarcações nacionais e internacionais.</p><p>Localizada estrategicamente em Paranaguá (PR), um dos principais polos portuários da América Latina, a empresa reúne experiência técnica, agilidade e compromisso com os padrões internacionais de segurança.</p><p>Nosso trabalho contribui para a proteção de vidas, cargas e patrimônio, por meio de serviços de inspeção, manutenção e certificação de equipamentos essenciais à segurança a bordo.</p><h2>Compromisso com a operação</h2><p>A segurança das embarcações depende de equipamentos de proteção e salvatagem confiáveis. Nossa equipe atende às necessidades de inspeção e manutenção com foco na segurança, na qualidade técnica e na continuidade operacional.</p><p>Informações específicas sobre qualificações, escopos de serviço e homologações devem ser confirmadas com a equipe antes da publicação.</p><h2>Equipe técnica</h2><p>Profissionais dedicados ao atendimento de demandas de segurança marítima e à execução dos serviços para os quais estejam devidamente qualificados.</p></div></section>
<section class="mv-section mv-section--soft" id="instalacoes"><div class="mv-container"><p class="mv-eyebrow">Estrutura e capacidade técnica</p><h2>Nossa Estrutura</h2><p class="mv-lead">Instalações em Paranaguá dedicadas à inspeção e manutenção de equipamentos de salvatagem.</p><div class="mv-gallery"><img src="{{asset:images/facilities/estrutura-oficina-balsas.webp}}" alt="Balsas salva-vidas na oficina da MV Safety" loading="lazy"><img src="{{asset:images/facilities/estrutura-manutencao.webp}}" alt="Atividade de manutenção de equipamentos de salvatagem" loading="lazy"><img src="{{asset:images/facilities/estrutura-balsas-modelos.webp}}" alt="Modelos de balsas salva-vidas nas instalações" loading="lazy"><img src="{{asset:images/facilities/fachada-mv-safety.webp}}" alt="Fachada da MV Safety em Paranaguá" loading="lazy"></div></div></section>
<section class="mv-section mv-contact-cta"><div class="mv-container"><h2>Conte com uma equipe especializada.</h2><a class="mv-button" href="{{page:contact}}">Solicitar Orçamento</a></div></section>
HTML,
			'services' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Serviços especializados</p><h1>Nossas Soluções em Segurança Marítima</h1><p>Inspeção e manutenção para equipamentos essenciais à segurança a bordo.</p></div></div>
<section class="mv-section"><div class="mv-container mv-prose"><p class="mv-lead">A MV Safety oferece serviços de inspeção e manutenção de equipamentos de segurança marítima, com foco na proteção da tripulação e na conformidade operacional das embarcações.</p></div><div class="mv-container mv-service-grid">
	<article class="mv-card"><img src="{{asset:images/services/servico-combate-incendio-ilustrativo.jpg}}" alt="Imagem ilustrativa de combate a incêndio a bordo" loading="lazy"><div class="mv-card__body"><h2>Combate a Incêndio</h2><p>Manutenção, inspeção e recarga de sistemas e equipamentos de combate a incêndio a bordo, contribuindo para sua confiabilidade e prontidão em situações de emergência.</p><a class="mv-button" href="{{page:firefighting}}">Saiba mais</a></div></article>
	<article class="mv-card"><img src="{{asset:images/services/servico-balsas-salva-vidas.webp}}" alt="Balsas salva-vidas nas instalações da MV Safety" loading="lazy"><div class="mv-card__body"><h2>Balsas Salva-vidas</h2><p>Inspeção e manutenção completa de balsas salva-vidas, seguindo os procedimentos técnicos aplicáveis para preservar as condições de segurança e funcionamento dos equipamentos.</p><a class="mv-button" href="{{page:liferafts}}">Saiba mais</a></div></article>
	<article class="mv-card"><img src="{{asset:images/services/servico-bote-resgate-ilustrativo.jpg}}" alt="Imagem ilustrativa de bote de resgate" loading="lazy"><div class="mv-card__body"><h2>Botes de Resgate</h2><p>Revisão e certificação de baleeiras, botes de resgate e sistemas de lançamento (turcos), visando à segurança e confiabilidade das operações de emergência.</p><a class="mv-button" href="{{page:rescue_boats}}">Saiba mais</a></div></article>
</div></section>
HTML,
			'firefighting' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Serviços</p><h1>Combate a Incêndio</h1><p>Inspeção, manutenção e recarga de equipamentos de proteção contra incêndio a bordo.</p></div></div>
<section class="mv-section"><div class="mv-container mv-two-column mv-service-detail"><div class="mv-prose"><h2>Prontidão e confiabilidade</h2><p>A MV Safety realiza serviços de manutenção, inspeção e recarga de sistemas e equipamentos de combate a incêndio a bordo, contribuindo para sua confiabilidade e prontidão em situações de emergência.</p><p>O escopo e os procedimentos aplicáveis dependem do equipamento e devem ser confirmados com a equipe técnica antes da contratação. Não são informados prazos ou normas específicos sem validação.</p><h2>Atendimento especializado</h2><p>Entre em contato para informar o tipo de equipamento e as necessidades da sua embarcação. A equipe poderá avaliar o serviço adequado e os próximos passos.</p><a class="mv-button" href="{{page:contact}}">Solicitar Orçamento</a></div><img src="{{asset:images/services/servico-combate-incendio-ilustrativo.jpg}}" alt="Imagem ilustrativa de equipamento de combate a incêndio" loading="lazy"></div></section>
HTML,
			'liferafts' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Serviços</p><h1>Balsas Salva-vidas</h1><p>Inspeção e manutenção para apoiar a segurança e a prontidão dos equipamentos.</p></div></div>
<section class="mv-section"><div class="mv-container mv-two-column mv-service-detail"><div class="mv-prose"><h2>Inspeção e manutenção</h2><p>A MV Safety realiza inspeção e manutenção completa de balsas salva-vidas, seguindo os procedimentos técnicos aplicáveis para preservar as condições de segurança e funcionamento dos equipamentos.</p><p>O escopo do serviço depende do modelo e das condições do equipamento. Prazos, normas aplicáveis e itens incluídos devem ser confirmados pela equipe técnica para cada atendimento.</p><h2>Solicite uma avaliação</h2><p>Informe o modelo do equipamento e os dados da embarcação para que nossa equipe possa orientar o atendimento.</p><a class="mv-button" href="{{page:contact}}">Solicitar Orçamento</a></div><img src="{{asset:images/services/inspecao-balsas-salva-vidas.webp}}" alt="Inspeção de balsas salva-vidas nas instalações" loading="lazy"></div></section>
HTML,
			'rescue_boats' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Serviços</p><h1>Botes de Resgate</h1><p>Revisão e certificação de baleeiras, botes de resgate e sistemas de lançamento.</p></div></div>
<section class="mv-section"><div class="mv-container mv-two-column mv-service-detail"><div class="mv-prose"><h2>Segurança nas operações de emergência</h2><p>A MV Safety realiza revisão e certificação de baleeiras, botes de resgate e sistemas de lançamento (turcos), visando à segurança e confiabilidade das operações de emergência.</p><p>Os serviços e a documentação aplicáveis variam conforme o equipamento e devem ser validados com a equipe técnica. Não são presumidos procedimentos, normas ou prazos específicos.</p><h2>Fale com a equipe</h2><p>Entre em contato para avaliar as necessidades do equipamento e da embarcação.</p><a class="mv-button" href="{{page:contact}}">Solicitar Orçamento</a></div><img src="{{asset:images/services/servico-bote-resgate-ilustrativo.jpg}}" alt="Imagem ilustrativa de bote de resgate" loading="lazy"></div></section>
HTML,
			'certifications' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Conformidade e qualidade</p><h1>Certificações Internacionais</h1><p>Rigor técnico, procedimentos confiáveis e compromisso com a segurança marítima.</p></div></div>
<section class="mv-section"><div class="mv-container mv-prose"><h2>Informações sujeitas a validação</h2><p>A segurança marítima exige rigor técnico, procedimentos confiáveis e conformidade com padrões aplicáveis. A MV Safety desenvolve seus serviços com foco nessas exigências, buscando assegurar qualidade e confiança em cada operação.</p><p>As sociedades classificadoras abaixo são referências mencionadas no material do projeto. Sua inclusão não confirma homologação, autorização, certificação vigente ou escopo de serviço da MV Safety. Essas informações, assim como os respectivos logotipos, só devem ser publicadas após validação documental.</p><div class="mv-cert-grid"><article><h2>DNV</h2><p>Det Norske Veritas</p><small>Escopo e situação: confirmar documentalmente.</small></article><article><h2>NKK</h2><p>Nippon Kaiji Kyokai</p><small>Escopo e situação: confirmar documentalmente.</small></article><article><h2>Bureau Veritas</h2><p>BV</p><small>Escopo e situação: confirmar documentalmente.</small></article><article><h2>Lloyd's Register</h2><p>LR</p><small>Escopo e situação: confirmar documentalmente.</small></article></div></div></section>
HTML,
			'contact' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Fale com a MV Safety</p><h1>Entre em contato com a MV Safety</h1><p>Nossa equipe está preparada para atender às necessidades de segurança marítima da sua embarcação.</p></div></div>
<section class="mv-section"><div class="mv-container mv-contact-layout"><div class="mv-prose"><h2>Solicite atendimento especializado</h2><p>Envie os dados da sua solicitação. Nossa equipe entrará em contato usando as informações fornecidas.</p><p><strong>Localização:</strong> Paranaguá (PR), Brasil<br><strong>Atendimento:</strong> 24 horas</p><p>Telefone e e-mail podem ser adicionados pelo administrador nas configurações do tema.</p></div><div>[mvsafety_contact_form]</div></div></section>
HTML,
			'privacy' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Privacidade e proteção de dados</p><h1>Política de Privacidade</h1><p>Informações sobre dados enviados por meio deste site.</p></div></div>
<section class="mv-section"><div class="mv-container mv-prose"><div class="mv-review-notice"><strong>Rascunho para validação:</strong> este texto descreve o formulário incluído no tema e precisa ser revisado pelo responsável jurídico e pelo encarregado de dados da MV Safety antes da publicação. Complete os dados de contato e confirme os processos efetivamente adotados.</div><h2>Dados enviados pelo formulário</h2><p>O formulário pode solicitar nome, empresa, e-mail, telefone, serviço de interesse, nome da embarcação (opcional) e mensagem. Esses dados são utilizados para analisar e responder à solicitação de contato.</p><h2>Compartilhamento e retenção</h2><p>Defina aqui os destinatários, prestadores de serviço envolvidos no recebimento de mensagens, prazos de retenção e medidas de segurança aplicáveis. O tema envia a solicitação ao endereço administrativo configurado no WordPress e não mantém um banco de dados próprio de contatos enviados.</p><h2>Direitos do titular</h2><p>O titular pode solicitar informações sobre o tratamento de seus dados, correção, eliminação quando cabível ou exercer outros direitos previstos na legislação aplicável. Informe abaixo um canal validado para essas solicitações.</p><p><strong>Canal de privacidade:</strong> preencher com o contato oficial aprovado pela MV Safety antes da publicação.</p><h2>Cookies e serviços de terceiros</h2><p>Plugins, ferramentas de análise, hospedagem e serviços de envio de e-mail podem tratar dados conforme suas configurações. Identifique e revise todos os serviços efetivamente ativos no site antes de aprovar esta política.</p></div></section>
HTML,
		),
		'en' => array(
			'home' => <<<'HTML'
<section class="mv-hero">
	<img class="mv-hero__image" src="{{asset:images/hero/hero-conceito-IA-ampliado-1920.jpg}}" alt="Illustrative concept image of a liferaft at sea" fetchpriority="high" decoding="async">
	<div class="mv-hero__shade"></div>
	<div class="mv-hero__content">
		<p class="mv-eyebrow">Safety for maritime operations</p>
		<h1>GLOBAL MARITIME SAFETY</h1>
		<p>Protecting lives, cargo and assets.</p>
		<small>Illustrative concept image.</small>
	</div>
</section>
<section class="mv-section mv-about-preview"><div class="mv-container mv-two-column"><div><p class="mv-eyebrow">Experience, expertise and commitment</p><h2>Specialists in firefighting and lifesaving</h2><p>Since 2001, MV Safety has worked in maritime safety engineering, providing specialist solutions for Brazilian and international vessels.</p><p>Strategically located in Paranaguá, Paraná, Brazil, one of Latin America's major port hubs, the company combines technical experience, responsive service and a commitment to international safety standards.</p><p>Our work helps protect lives, cargo and assets through the inspection, maintenance and certification of essential onboard safety equipment.</p><a class="mv-text-link" href="{{page:company}}">Meet MV Safety <span aria-hidden="true">→</span></a></div><div class="mv-about-mark" aria-hidden="true"><span>MV</span><strong>SAFETY</strong><small>PARANAGUÁ · BRAZIL</small></div></div></section>
<section class="mv-section mv-section--soft"><div class="mv-container"><div class="mv-section-heading"><p class="mv-eyebrow">Our services</p><h2>Complete maritime safety solutions</h2><p>Specialist inspection, maintenance and certification services for safety equipment, focused on crew protection and vessel operational compliance.</p></div><div class="mv-service-grid">
	<article class="mv-card"><img src="{{asset:images/services/servico-combate-incendio-ilustrativo.jpg}}" alt="Illustrative image of firefighting equipment" loading="lazy" decoding="async"><div class="mv-card__body"><img class="mv-icon" src="{{asset:icons/icone-incendio.svg}}" alt="" loading="lazy"><h3>Firefighting Equipment</h3><p>Maintenance, inspection and recharging of onboard firefighting systems and equipment, helping maintain reliability and readiness for emergencies.</p><a class="mv-text-link" href="{{page:firefighting}}">Learn more <span aria-hidden="true">→</span></a></div></article>
	<article class="mv-card"><img src="{{asset:images/services/servico-balsas-salva-vidas.webp}}" alt="Liferafts at MV Safety facilities" loading="lazy" decoding="async"><div class="mv-card__body"><img class="mv-icon" src="{{asset:icons/icone-balsa.svg}}" alt="" loading="lazy"><h3>Liferafts</h3><p>Comprehensive liferaft inspection and maintenance, following applicable technical procedures to preserve equipment safety and functionality.</p><a class="mv-text-link" href="{{page:liferafts}}">Learn more <span aria-hidden="true">→</span></a></div></article>
	<article class="mv-card"><img src="{{asset:images/services/servico-bote-resgate-ilustrativo.jpg}}" alt="Illustrative image of a rescue boat" loading="lazy" decoding="async"><div class="mv-card__body"><img class="mv-icon" src="{{asset:icons/icone-bote.svg}}" alt="" loading="lazy"><h3>Rescue Boats</h3><p>Inspection and certification of lifeboats, rescue boats and launching appliances, supporting the safety and reliability of emergency operations.</p><a class="mv-text-link" href="{{page:rescue_boats}}">Learn more <span aria-hidden="true">→</span></a></div></article>
</div></div></section>
<section class="mv-section"><div class="mv-container mv-cert-preview"><div><p class="mv-eyebrow">Compliance and quality</p><h2>International Certifications</h2><p>Maritime safety requires technical rigour, reliable procedures and compliance with applicable international standards.</p><p>MV Safety develops its services with these requirements in mind, aiming to provide quality and confidence in every operation.</p><a class="mv-text-link" href="{{page:certifications}}">View certification information <span aria-hidden="true">→</span></a></div><p class="mv-document-note">Information about classification societies and approvals is subject to documentary verification.</p></div></section>
<section class="mv-section mv-section--soft"><div class="mv-container"><div class="mv-section-heading"><p class="mv-eyebrow">What sets us apart</p><h2>Why choose MV Safety?</h2></div><div class="mv-feature-grid">
	<article><img class="mv-icon" src="{{asset:icons/icone-trofeu.svg}}" alt="" loading="lazy"><h3>Established Experience</h3><p>More than two decades in the maritime sector, providing technical solutions focused on vessel safety.</p></article>
	<article><img class="mv-icon" src="{{asset:icons/icone-localizacao.svg}}" alt="" loading="lazy"><h3>Strategic Location</h3><p>Based in Paranaguá, Paraná, Brazil, with a strategic location for port operations and service across Brazil.</p></article>
	<article><img class="mv-icon" src="{{asset:icons/icone-equipe.svg}}" alt="" loading="lazy"><h3>Qualified Technical Team</h3><p>Professionals trained to meet maritime safety requirements of the International Maritime Organization (IMO) and the Brazilian maritime authority.</p></article>
	<article><img class="mv-icon" src="{{asset:icons/icone-relogio-24h.svg}}" alt="" loading="lazy"><h3>24/7 Support</h3><p>Available to support operational needs and urgent situations in the maritime sector.</p></article>
</div></div></section>
<section class="mv-facility-band"><div class="mv-facility-band__copy"><p class="mv-eyebrow">Facilities and technical capability</p><h2>Our Facilities</h2><p>Located in Paranaguá, Paraná, MV Safety has facilities dedicated to maritime safety services, including the inspection and maintenance of lifesaving equipment.</p><p>Our facilities and technical experience enable us to serve Brazilian and international vessels with organisation, precision and a commitment to safety.</p><a class="mv-button mv-button--light" href="{{page:company}}#instalacoes">Explore our facilities</a></div><img src="{{asset:images/facilities/estrutura-oficina-balsas.webp}}" alt="Liferafts at MV Safety facilities" loading="lazy" decoding="async"></section>
<section class="mv-section mv-contact-cta"><div class="mv-container"><p class="mv-eyebrow">Talk to MV Safety</p><h2>Safety for your vessel.<br>Confidence for your operation.</h2><p>Need inspection, maintenance or certification of maritime safety equipment?</p><p>Contact our team to request specialist support.</p><a class="mv-button" href="{{page:contact}}">Request a Quote</a></div></section>
HTML,
			'company' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Experience, expertise and commitment</p><h1>About MV Safety</h1><p>Maritime safety, firefighting and lifesaving services since 2001.</p></div></div>
<section class="mv-section"><div class="mv-container mv-prose"><h2>Maritime safety specialists</h2><p>Since 2001, MV Safety has worked in maritime safety engineering, providing specialist solutions for Brazilian and international vessels.</p><p>Strategically located in Paranaguá, Paraná, Brazil, one of Latin America's major port hubs, the company combines technical experience, responsive service and a commitment to international safety standards.</p><p>Our work helps protect lives, cargo and assets through the inspection, maintenance and certification of essential onboard safety equipment.</p><h2>Commitment to vessel operations</h2><p>Vessel safety depends on reliable protection and lifesaving equipment. Our team supports inspection and maintenance needs with a focus on safety, technical quality and operational continuity.</p><p>Specific information about qualifications, service scope and approvals should be confirmed with our team before publication.</p><h2>Technical team</h2><p>Professionals dedicated to maritime safety requirements and to performing services for which they are duly qualified.</p></div></section>
<section class="mv-section mv-section--soft" id="instalacoes"><div class="mv-container"><p class="mv-eyebrow">Facilities and technical capability</p><h2>Our Facilities</h2><p class="mv-lead">Facilities in Paranaguá dedicated to the inspection and maintenance of lifesaving equipment.</p><div class="mv-gallery"><img src="{{asset:images/facilities/estrutura-oficina-balsas.webp}}" alt="Liferafts at the MV Safety workshop" loading="lazy"><img src="{{asset:images/facilities/estrutura-manutencao.webp}}" alt="Lifesaving equipment maintenance" loading="lazy"><img src="{{asset:images/facilities/estrutura-balsas-modelos.webp}}" alt="Liferaft models at the facilities" loading="lazy"><img src="{{asset:images/facilities/fachada-mv-safety.webp}}" alt="MV Safety premises in Paranaguá" loading="lazy"></div></div></section>
<section class="mv-section mv-contact-cta"><div class="mv-container"><h2>Talk to our specialist team.</h2><a class="mv-button" href="{{page:contact}}">Request a Quote</a></div></section>
HTML,
			'services' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Specialist services</p><h1>Maritime Safety Solutions</h1><p>Inspection and maintenance for essential onboard safety equipment.</p></div></div>
<section class="mv-section"><div class="mv-container mv-prose"><p class="mv-lead">MV Safety provides inspection and maintenance services for maritime safety equipment, focused on crew protection and vessel operational compliance.</p></div><div class="mv-container mv-service-grid">
	<article class="mv-card"><img src="{{asset:images/services/servico-combate-incendio-ilustrativo.jpg}}" alt="Illustrative image of onboard firefighting" loading="lazy"><div class="mv-card__body"><h2>Firefighting Equipment</h2><p>Maintenance, inspection and recharging of onboard firefighting systems and equipment, helping maintain reliability and readiness for emergencies.</p><a class="mv-button" href="{{page:firefighting}}">Learn more</a></div></article>
	<article class="mv-card"><img src="{{asset:images/services/servico-balsas-salva-vidas.webp}}" alt="Liferafts at MV Safety facilities" loading="lazy"><div class="mv-card__body"><h2>Liferafts</h2><p>Comprehensive liferaft inspection and maintenance, following applicable technical procedures to preserve equipment safety and functionality.</p><a class="mv-button" href="{{page:liferafts}}">Learn more</a></div></article>
	<article class="mv-card"><img src="{{asset:images/services/servico-bote-resgate-ilustrativo.jpg}}" alt="Illustrative image of a rescue boat" loading="lazy"><div class="mv-card__body"><h2>Rescue Boats</h2><p>Inspection and certification of lifeboats, rescue boats and launching appliances, supporting the safety and reliability of emergency operations.</p><a class="mv-button" href="{{page:rescue_boats}}">Learn more</a></div></article>
</div></section>
HTML,
			'firefighting' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Services</p><h1>Firefighting Equipment</h1><p>Inspection, maintenance and recharging of onboard fire protection equipment.</p></div></div>
<section class="mv-section"><div class="mv-container mv-two-column mv-service-detail"><div class="mv-prose"><h2>Readiness and reliability</h2><p>MV Safety provides maintenance, inspection and recharging services for onboard firefighting systems and equipment, helping maintain reliability and readiness for emergencies.</p><p>Service scope and applicable procedures depend on the equipment and should be confirmed with the technical team before engagement. No specific inspection intervals or standards are stated without verification.</p><h2>Specialist support</h2><p>Tell us about the equipment and your vessel's requirements. Our team can assess the appropriate service and next steps.</p><a class="mv-button" href="{{page:contact}}">Request a Quote</a></div><img src="{{asset:images/services/servico-combate-incendio-ilustrativo.jpg}}" alt="Illustrative image of firefighting equipment" loading="lazy"></div></section>
HTML,
			'liferafts' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Services</p><h1>Liferafts</h1><p>Inspection and maintenance to support equipment safety and readiness.</p></div></div>
<section class="mv-section"><div class="mv-container mv-two-column mv-service-detail"><div class="mv-prose"><h2>Inspection and maintenance</h2><p>MV Safety provides comprehensive liferaft inspection and maintenance, following applicable technical procedures to preserve equipment safety and functionality.</p><p>Service scope depends on the equipment model and condition. Applicable intervals, standards and included items should be confirmed by the technical team for each service request.</p><h2>Request an assessment</h2><p>Share the equipment model and vessel details so our team can advise on the service.</p><a class="mv-button" href="{{page:contact}}">Request a Quote</a></div><img src="{{asset:images/services/inspecao-balsas-salva-vidas.webp}}" alt="Liferaft inspection at the facilities" loading="lazy"></div></section>
HTML,
			'rescue_boats' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Services</p><h1>Rescue Boats and Lifeboats</h1><p>Inspection and certification of lifeboats, rescue boats and launching appliances.</p></div></div>
<section class="mv-section"><div class="mv-container mv-two-column mv-service-detail"><div class="mv-prose"><h2>Safety in emergency operations</h2><p>MV Safety provides inspection and certification of lifeboats, rescue boats and launching appliances, supporting the safety and reliability of emergency operations.</p><p>Applicable services and documentation vary by equipment and should be verified with the technical team. No procedures, standards or intervals are assumed.</p><h2>Talk to our team</h2><p>Contact us to discuss the equipment and your vessel's requirements.</p><a class="mv-button" href="{{page:contact}}">Request a Quote</a></div><img src="{{asset:images/services/servico-bote-resgate-ilustrativo.jpg}}" alt="Illustrative image of a rescue boat" loading="lazy"></div></section>
HTML,
			'certifications' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Compliance and quality</p><h1>International Certifications</h1><p>Technical rigour, reliable procedures and a commitment to maritime safety.</p></div></div>
<section class="mv-section"><div class="mv-container mv-prose"><h2>Information subject to verification</h2><p>Maritime safety requires technical rigour, reliable procedures and compliance with applicable standards. MV Safety develops its services with these requirements in mind, aiming to provide quality and confidence in every operation.</p><p>The classification societies listed below were mentioned in the project materials. Their inclusion does not confirm any current MV Safety approval, authorisation, certification or service scope. Documentary verification is required before publishing this information or using the relevant logos.</p><div class="mv-cert-grid"><article><h2>DNV</h2><p>Det Norske Veritas</p><small>Scope and status: subject to documentary verification.</small></article><article><h2>NKK</h2><p>Nippon Kaiji Kyokai</p><small>Scope and status: subject to documentary verification.</small></article><article><h2>Bureau Veritas</h2><p>BV</p><small>Scope and status: subject to documentary verification.</small></article><article><h2>Lloyd's Register</h2><p>LR</p><small>Scope and status: subject to documentary verification.</small></article></div></div></section>
HTML,
			'contact' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Talk to MV Safety</p><h1>Contact MV Safety</h1><p>Our team is ready to support your vessel's maritime safety needs.</p></div></div>
<section class="mv-section"><div class="mv-container mv-contact-layout"><div class="mv-prose"><h2>Request specialist support</h2><p>Send us the details of your enquiry. Our team will follow up using the information provided.</p><p><strong>Location:</strong> Paranaguá, Paraná, Brazil<br><strong>Support:</strong> 24/7</p><p>Phone and email details can be added by the site administrator in the theme settings.</p></div><div>[mvsafety_contact_form]</div></div></section>
HTML,
			'privacy' => <<<'HTML'
<div class="mv-page-hero"><div class="mv-container"><p class="mv-eyebrow">Privacy and data protection</p><h1>Privacy Policy</h1><p>Information about data submitted through this website.</p></div></div>
<section class="mv-section"><div class="mv-container mv-prose"><div class="mv-review-notice"><strong>Draft for review:</strong> this text describes the form included with the theme and must be reviewed by MV Safety's legal representative and data protection contact before publication. Complete the contact details and confirm the actual processing arrangements.</div><h2>Information submitted through the form</h2><p>The form may request a name, company, email address, telephone number, service of interest, optional vessel name and message. This information is used to review and respond to the enquiry.</p><h2>Sharing and retention</h2><p>Specify the recipients, service providers involved in message delivery, retention periods and applicable security measures. The theme sends the enquiry to the administrative email configured in WordPress and does not maintain its own database of submitted contacts.</p><h2>Data subject rights</h2><p>Individuals may request information about the processing of their data, correction, erasure where applicable, or exercise other rights available under applicable law. Provide a verified contact channel for such requests.</p><p><strong>Privacy contact:</strong> add the official contact approved by MV Safety before publication.</p><h2>Cookies and third-party services</h2><p>Plugins, analytics tools, hosting and email delivery services may process data according to their settings. Identify and review every service actually active on the website before approving this policy.</p></div></section>
HTML,
		),
	);

	return $content[ $english ? 'en' : 'pt' ][ $key ] ?? '';
}
