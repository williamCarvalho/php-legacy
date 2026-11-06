[Inglês](README.md) | [Português](README.pt.md)

# 🔄 Projeto de Modernização de Legado: Monolito PHP Orientado a Objetos para API REST + SPA Moderna

Este repositório demonstra a estratégia de refatoração e modernização de um sistema legado monolítico em PHP OO, transformando-o em uma arquitetura desacoplada baseada em **API RESTful (PHP Nativo)** consumida por um **Painel SPA em React**.

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

- **Legado & API Backend:** PHP Nativo (POO, PSR standards, PDO)
- **Frontend Moderno:** React / Vue.js, Tailwind CSS (ou MUI), Axios/Fetch
- **Banco de Dados:** MySQL / PostgreSQL
- **Padrões e Princípios:** REST, MVC / Repository Pattern, SOLID (Single Responsibility e Dependency Inversion)

---

## 🚀 Principais Ganhos da Refatoração

1. **Reutilização de Código:** A nova API permite que futuros clientes (mobile, integrações de terceiros) consumam os mesmos dados sem alterar o backend.
2. **Redução de Acoplamento:** A lógica de renderização foi zerada no servidor, reduzindo a carga do backend para o envio de payloads JSON compactos.
3. **Facilidade em Testes:** A separação em Controllers e Repositories permite isolar consultas SQL da regra de negócio para testes mais consistentes.

---

## 📂 Visão Geral do Código

### Trecho Legado (`01-legacy/src/UserProcess.php`)

_(Trecho exemplificando a mistura de HTML, processamento POST direto e consultas SQL)_

### Trecho Modernizado (`02-modern-api/src/Controllers/UserController.php`)

_(Trecho mostrando tratamento de requisição REST, validação e resposta JSON com status HTTP adequados)_
