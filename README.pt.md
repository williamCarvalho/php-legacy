[Inglês](README.md) | [Português](README.pt.md)

# 🔄 Projeto de Modernização de Legado: Monolito PHP Orientado a Objetos para API REST + SPA Moderna

Este repositório demonstra a estratégia de refatoração e modernização de um sistema legado monolítico em PHP OO, transformando-o em uma arquitetura desacoplada baseada em **API RESTful (PHP Nativo)** consumida por um **Frontend SPA em React**.

---

## 📊 Arquitetura: Antes vs. Depois

### 🔴 Antes (Monolito Legado)

- **Acoplamento Forte:** Lógica de negócios, acesso ao banco (SQL) e renderização HTML/CSS misturados no mesmo fluxo.
- **Manutenibilidade:** Alta complexidade para adicionar novas features sem gerar efeitos colaterais.
- **Sem Separação de Camadas:** Requisições manipuladas diretamente por formulários tradicionais com reload de página.

```text
[ Browser ] ---> [ Script PHP Legado (SQL + Regra de Negócio + HTML) ] ---> [ Banco SQL ]
```

### 🟢 Depois (Arquitetura Desacoplada)

- **Separação de Responsabilidades:** Camada de dados/API completamente isolada da interface do usuário.
- **API RESTful Limpa:** Endpoints em PHP nativo estruturados com Front Controller, alinhados com o padrão JSON.
- **Frontend Reativo:** SPA moderna com gerenciamento de estado local e comunicação assíncrona.

```text
[ React SPA ] ---> HTTP / JSON ---> [ PHP REST API (Router -> Controller -> Repository) ] ---> [ Banco SQL ]
```

---

## 🛠️ Conjunto de tecnologias

O projeto está dividido em uma arquitetura de monorepo demonstrando a evolução de um sistema monolítico legado para uma arquitetura moderna desacoplada:

### 1. Monolito Legado (`/01-legacy`)

- **Linguagem:** PHP (Procedural/OO)
- **Banco de Dados:** MySQL (PDO)
- **Interface:** HTML5 / CSS3 com Bootstrap 5

### 2. API REST Moderna (`/02-modern-api`)

- **Linguagem:** PHP 8+ (OO)
- **Arquitetura:** Front Controller, Repository Pattern e Princípios SOLID
- **Banco de Dados:** MySQL (PDO e tratamento de exceções)
- **Comunicação:** API RESTful com suporte a CORS e payload JSON

### 3. Frontend SPA Moderno (`/03-frontend`)

- **Framework:** React (Vite)
- **UI Library:** Material UI (MUI)
- **Gerenciamento de Estado & Requisições:** Hooks nativos (`useState`, `useEffect`, `useCallback`) e API Fetch nativa com variáveis de ambiente (`.env`)

---

## 🚀 Principais Ganhos da Refatoração

1. **Reutilização de Código:** A nova API permite que futuros clientes (mobile, integrações de terceiros) consumam os mesmos dados sem alterar o backend.
2. **Redução de Acoplamento:** A lógica de renderização foi zerada no servidor, reduzindo a carga do backend para o envio de payloads JSON compactos.
3. **Facilidade em Testes:** A separação em Controllers e Repositories permite isolar consultas SQL da regra de negócio para testes mais consistentes.

---

## 📂 Visão Geral do Código

### Monolito Legado (`01-legacy/index.php`)

_(Demonstra a mistura de HTML, processamento de formulário POST e consultas SQL diretas no mesmo arquivo)_

### Backend Moderno - Roteamento (`02-modern-api/public/index.php`)

_(Ponto de entrada único responsável pelo tratamento de CORS, normalização de URIs e despacho de requisições)_

### Backend Moderno - Conexão (`02-modern-api/src/database.php`)

_(Gerenciamento centralizado da conexão com o banco de dados utilizando PDO)_

### Backend Moderno - Repositório (`02-modern-api/src/order-repository.php`)

_(Isolamento da persistência de dados e queries SQL protegidas com Prepared Statements)_

### Backend Moderno - Controller (`02-modern-api/src/order-controller.php`)

_(Trecho mostrando tratamento de requisição REST, validação e resposta JSON com status HTTP adequados)_

### Frontend SPA Moderno (`03-frontend/src/App.jsx`)

_(Interface em React com Material UI gerindo estados reativos, formulários e consumo assíncrono via Fetch)_
