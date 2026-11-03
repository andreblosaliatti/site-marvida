# MV Safety — pacote de ativos para Elementor

## Conteúdo
- `01_logo/`: logotipo recortado da foto original fornecida, PNG com transparência, versão ampliada (sem ganho de detalhe real), versão branca e favicon ilustrativo. **O logo não é um vetor oficial.**
- `02_hero/`: conceito do hero no mar (recorte de imagem de IA do mockup, sem textos; versão ampliada por interpolação) e alternativa com foto real em oficina.
- `03_servicos/`: fotos reais de balsas/equipamentos e fotos ilustrativas geradas por IA para combate a incêndio, balsa no mar e bote de resgate.
- `04_estrutura/`: fotos reais da oficina e fachada, mais uma referência ilustrativa gerada por IA.
- `05_icones_svg/`: 12 ícones vetoriais verdes SVG independentes (64 x 64 viewBox; escala ilimitada).
- `06_fundos_svg/`: 4 fundos/formas em SVG independentes.
- `07_cores_e_guia/`: paleta JSON e CSS.
- `08_referencias/`: mockup completo aprovado, apenas como referência, NÃO para usar como uma imagem da homepage.

## Uso no Elementor
1. Importar as imagens WebP para serviço e estrutura; manter originais JPG como backup.
2. No hero, usar a imagem como **background**, posição center center, cobertura cover, com títulos reais do Elementor por cima. Não embutir texto na imagem.
3. Ícones SVG exigem autorização/configuração segura de uploads no WordPress. Evitar ativar upload arbitrário de SVG; usar um sanitizador ou converter para PNG localmente.
4. Paleta: verde #00813C como cor principal; verde escuro #00432F no rodapé; azul-marinho #0B2547 nos textos.
5. Montar textos, botões e links como elementos nativos do Elementor; não usar recortes de print para isso.

## Limitações de qualidade e autenticidade
- As fotografias reais enviadas medem até cerca de 1599 px no lado maior; não equivalem a fotos nativas 4K.
- O hero conceitual vem de um recorte do mockup gerado por IA, com resolução efetiva limitada (547x207). O JPG 1920 é somente ampliação de pixels. Para hero final em alta definição, é necessário gerar/obter uma imagem independente em 1920+ px.
- Imagens ilustrativas de IA não são fotografias de operações reais da MV Safety. Use identificações corretas.
- **Logos das sociedades classificadoras não foram incluídos**: obtenha arquivos oficiais e verifique a autorização e escopo das homologações antes de usá-los.
- Dados de telefone/e-mail nos mockups não foram confirmados e não estão fixados neste pacote.
