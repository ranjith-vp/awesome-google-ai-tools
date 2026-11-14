# Awesome Google AI Tools [![Awesome](https://awesome.re/badge.svg)](https://awesome.re) [![Companion Portal](https://img.shields.io/badge/Companion%20Portal-googleaitools.com-1a73e8.svg?style=flat-square&logo=google)](https://googleaitools.com) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](LICENSE) [![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](CONTRIBUTING.md)

> A meticulously curated directory of Google AI foundation models, developer SDKs, open weights, creative engines, agentic frameworks, and enterprise cloud tools — paired with benchmark guides, interactive reviews, and tutorials from [googleaitools.com](https://googleaitools.com).

---

## 📑 Table of Contents

- [📊 Structured Comparison Tables](#-structured-comparison-tables)
  - [1. LLM & Multimodal Models Matrix](#1-llm--multimodal-models-matrix)
  - [2. Generative Media Models Matrix](#2-generative-media-models-matrix)
  - [3. Developer Platforms & Sandboxes](#3-developer-platforms--sandboxes)
  - [4. AI Agents & Productivity Workspaces](#4-ai-agents--productivity-workspaces)
- [🌐 Global AI Startup & Product Discovery (495 Curated Tools)](#-global-ai-startup--product-discovery)
- [🧠 Foundation Models](#-foundation-models)
  - [Proprietary API Models (Gemini Family)](#proprietary-api-models-gemini-family)
  - [Open Weights Models (Gemma Family)](#open-weights-models-gemma-family)
- [🎨 Creative & Generative Media](#-creative--generative-media)
  - [Image Generation & Editing](#image-generation--editing)
  - [Video Generation](#video-generation)
  - [Audio, Speech & Music](#audio-speech--music)
  - [AI Watermarking & Provenance](#ai-watermarking--provenance)
- [🛠️ Developer Tools, SDKs & APIs](#️-developer-tools-sdks--apis)
- [🤖 Autonomous Agents & Coding Tools](#-autonomous-agents--coding-tools)
- [⚡ AI Infrastructure & Compute (TPUs)](#-ai-infrastructure--compute-tpus)
- [📚 Tutorials, Guides & Deep Dives](#-tutorials-guides--deep-dives)
- [🤝 Contributing](#-contributing)
- [⚖️ License](#️-license)

---

## 📊 Structured Comparison Tables

All comparison tables are synchronized with our machine-readable datasets in [`data/comparison-matrix.json`](data/comparison-matrix.json) and [`data/models-comparison.csv`](data/models-comparison.csv).

### 1. LLM & Multimodal Models Matrix

| Model | Type | Context Window | Max Output | Input Modalities | Free Tier | Pricing (per 1M tokens) | Primary Advantage / Best Use Case | In-Depth Guide |
| :--- | :--- | :--- | :--- | :--- | :---: | :--- | :--- | :--- |
| **Gemini 4 Hydrogen** | Proprietary API | **10,000,000** (10M) | 16,384 | Text, Code, Audio, 4K Video, Robotics | ✅ Yes | **$1.25** in / **$5.00** out | Recursive test-time reasoning, 10M context, TPU v6 Trillium | [Model Specs](https://googleaitools.com/models/gemini-4-hydrogen/) |
| **Gemini 1.5 Pro** | Proprietary API | **2,097,152** (2M) | 8,192 | Text, Code, Audio, Video, PDF, Images | ✅ Yes | **$3.50** in / **$10.50** out *(<=128k)* | Massive multimodal context (hours of video, 1M+ LOC) | [Read Guide](https://googleaitools.com/getting-started-with-gemini-1-5-pro/) |
| **Gemini 1.5 Flash** | Proprietary API | **1,048,576** (1M) | 8,192 | Text, Code, Audio, Video, Images | ✅ Yes | **$0.075** in / **$0.30** out *(<=128k)* | Sub-second latency, high-volume production tasks | [Read Guide](https://googleaitools.com/how-to-use-gemini-15-flash/) |
| **Gemini 1.0 Ultra** | Enterprise API | 32,768 | 4,096 | Text, Code, Images | ❌ No | Consumer: $19.99/mo (Google One AI) | State-of-the-art complex academic/scientific reasoning | [Read Review](https://googleaitools.com/gemini-api-review-benchmarks-specs/) |
| **Gemma 2 (27B)** | Open Weights | 8,192 | 4,096 | Text, Code | ✅ Free | Hardware/Hosting only | Outperforms larger 70B models on single GPU setups | [Read Guide](https://googleaitools.com/gemma-open-source-ai-models-guide/) |
| **Gemma 2 (9B)** | Open Weights | 8,192 | 4,096 | Text, Code | ✅ Free | Hardware/Hosting only | Best performance-per-watt for local consumer GPUs | [Read Guide](https://googleaitools.com/gemma-open-source-ai-models-guide/) |
| **Gemma 2 (2B)** | Open Weights | 8,192 | 2,048 | Text, Code | ✅ Free | Hardware/Hosting only | Ultra-fast edge inference, runs on CPUs & phones | [Read Guide](https://googleaitools.com/gemma-open-source-ai-models-guide/) |
| **PaliGemma 2** | Open Weights | Variable | 1,024 | Images, Text | ✅ Free | Hardware/Hosting only | Vision-Language: Object detection, OCR, spatial grounding | [Explore](https://ai.google.dev/gemma/docs/paligemma) |
| **CodeGemma** | Open Weights | 8,192 | 4,096 | Code, Text | ✅ Free | Hardware/Hosting only | Specialized for code completion, infilling, and synthesis | [Explore](https://ai.google.dev/gemma/docs/codegemma) |

---

### 2. Generative Media Models Matrix

| Engine | Media Type | Resolution / Output | Quality & Physics Controls | Watermarking | Access Method | Guide & Tutorial |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| **Imagen 3** | Photorealistic Images | Up to 2048x2048 | High fidelity, accurate text rendering, studio lighting | Invisible **SynthID** | Vertex AI API / ImageFX | [Imagen 3 Guide](https://googleaitools.com/imagen-3-prompt-engineering-tips/) |
| **Google Veo** | Cinematic Video | 1080p Full HD (>60s) | Camera pans, aerial shots, 24fps film style, visual coherence | Embedded **SynthID** | Vertex AI / VideoFX Preview | [Veo Tutorial](https://googleaitools.com/google-veo-video-generation-tutorial/) |
| **MusicLM / Lyria** | High-Fidelity Audio | 48kHz Stereo Audio | Musical genres, instrument isolation, mood transitions | SynthID for Audio | AI Test Kitchen / Music AI Lab | [Audio AI Guide](https://googleaitools.com/) |
| **SynthID** | Provenance Detection | Multi-modal imperceptible watermark | Cryptographically resilient to compression, filters & edits | Native Detection API | Open Weights & Google Cloud API | [Safety Guide](https://googleaitools.com/responsible-ai-principles-framework-guide/) |

---

### 3. Developer Platforms & Sandboxes

| Platform | Primary Audience | Key Capability | Free Quota | Enterprise Compliance | Direct Link |
| :--- | :--- | :--- | :---: | :---: | :--- |
| **Google AI Studio** | Developers & Hackers | Instant prototyping, system prompt testing, direct API key export | ✅ Generous | Prototyping focus | [ai.google.dev](https://aistudio.google.com/) |
| **Vertex AI** | Enterprise Engineers | Production MLOps, model garden, private VPC, tuning & governance | 🎁 $300 Credits | SOC 2, HIPAA, ISO | [cloud.google.com/vertex-ai](https://cloud.google.com/vertex-ai) |
| **Firebase AI Logic** | Fullstack & Mobile Devs | Client-side safe Gemini SDKs with Firebase Auth integration | ✅ Spark Free Tier | Firebase Security Rules | [firebase.google.com](https://firebase.google.com/docs/genai) |
| **Google Colab** | Researchers & Data Scientists | Hosted Jupyter notebooks with free/paid GPU/TPU acceleration | ✅ Free tier | Enterprise VPC with Colab Ent. | [colab.research.google.com](https://colab.research.google.com/) |

---

### 4. AI Agents & Productivity Workspaces

| Tool | Focus | Input Sources | Output & Interaction | Standout Feature | Tutorial Link |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **NotebookLM** | Research & Synthesis | PDFs, Google Docs, Slides, Web URLs, Audio | Structured notes, source citations, 2-host audio podcasts | **Audio Overview** (Natural conversational podcast generation) | [NotebookLM Guide](https://googleaitools.com/notebooklm-ai-research-guide/) |
| **Google Antigravity** | Autonomous Software Engineering | Full codebases, terminal execution, artifacts | Code edits, automated builds, test execution | Deep agentic architecture with specialized pairing subagents | [Antigravity Review](https://googleaitools.com/google-antigravity-review/) |
| **Project Jules** | Asynchronous Coding Agent | GitHub Repositories, Issue trackers | Automated Pull Requests, bug fixes, migration diffs | Runs independently in secure cloud workstations | [Jules Guide](https://googleaitools.com/jules-google-ai-coding-agent-guide/) |
| **Vertex AI Search & Conversation** | Enterprise RAG | Unstructured enterprise databases, BigQuery, intranet | Grounded chatbots, semantic document discovery | Out-of-the-box RAG with turnkey search connectors | [Vertex Search Docs](https://cloud.google.com/generative-ai-app-builder) |

---

## 🌐 Global AI Startup & Product Discovery

Explore our comprehensive breakdown of **495 real-world AI products, apps, and breakthrough startups** across 11 key industries in [**`GLOBAL_AI_DIRECTORY.md`**](GLOBAL_AI_DIRECTORY.md) and programmatically via [`data/global-ai-products.json`](data/global-ai-products.json):

1. **Personal AI Agents & Universal Assistants** (Gemini 4 Hydrogen, Manus, Genspark, Perplexity, ChatGPT Agent, Claude Computer Use, Rabbit R1, MultiOn, Copilot...)
2. **AI Browsers & Future Internet Access** (Dia, Comet, Arc, Opera Neon, Fellou, Browser Use, Browserbase, Steel, Firecrawl, Exa...)
3. **AI Software Development & App Creation** (Cursor, Windsurf, Lovable, Bolt.new, Replit Agent, Devin, Cline, OpenHands, v0, Base44...)
4. **AI Voice, Communication & Meetings** (ElevenLabs, Hume AI, Retell AI, Bland AI, Vapi, Cartesia, Wispr Flow, Granola, Fireflies, Plaud...)
5. **AI Creative, Video & Entertainment** (Runway, Pika, Luma AI, Kling AI, Sora, HeyGen, Synthesia, Suno, Udio, Ideogram, Midjourney...)
6. **AI Research, Knowledge & Intelligence** (Elicit, Consensus, SciSpace, Hebbia, Glean, NotebookLM, Recall, Mem, Exa, Tavily...)
7. **AI Business Automation & Enterprise** (Sierra, Harvey, Intercom Fin, Decagon, Moveworks, UiPath Autopilot, n8n, CrewAI, Agentforce...)
8. **AI Healthcare & Biotechnology** (Abridge, Ambience Healthcare, Hippocratic AI, Nabla, Suki, Insilico, Recursion, Isomorphic Labs, Qure.ai...)
9. **Robotics & Physical AI** (Figure AI, Physical Intelligence, 1X, Skild AI, Apptronik, Agility Robotics, Sanctuary, Waymo, Anduril, Zipline...)
10. **AI Infrastructure & Developer Ecosystem** (LangChain, LlamaIndex, Composio, MCP, Mem0, Letta, Pinecone, Weaviate, OpenRouter, LiteLLM...)
11. **AI Startups from India** (Sarvam AI, Krutrim, Yellow.ai, Haptik, Smallest.ai, CoRover, KissanAI, Gnani.ai, BharatGPT, Pixis...)

👉 **[Browse Full 495-Tool Directory & Analysis →](GLOBAL_AI_DIRECTORY.md)**

---

## 🧠 Foundation Models

### Proprietary API Models (Gemini Family)

- [Gemini 4 Hydrogen](https://googleaitools.com/models/gemini-4-hydrogen/) - Google DeepMind fourth-generation frontier powerhouse (Project Hydrogen) featuring an unprecedented 10M token context window, dynamic test-time recursive reasoning, and TPU v6 Trillium architecture.
- [Gemini 1.5 Pro](https://deepmind.google/technologies/gemini/pro/) - Frontier multimodal model with a record-shattering 2-million-token context window. Excels in audio/video comprehension and complex code analysis.
- [Gemini 1.5 Flash](https://deepmind.google/technologies/gemini/flash/) - Lightweight, ultra-fast workhorse model optimized for high frequency, cost-sensitive production workloads with a 1-million-token window.
- [Gemini 1.0 Ultra](https://deepmind.google/technologies/gemini/ultra/) - Flagship heavy-reasoning model engineered for complex scientific, mathematical, and reasoning tasks.
- [Gemini Nano](https://blog.google/technology/ai/gemini-android-aicore-developers/) - On-device efficient architecture powering Android AICore features, local smart replies, and privacy-preserving text summarization.

### Open Weights Models (Gemma Family)

- [Gemma 2](https://ai.google.dev/gemma) - State-of-the-art open models built from the same research and technology used to create Gemini. Available in **2B**, **9B**, and **27B** parameter sizes.
- [CodeGemma](https://ai.google.dev/gemma/docs/codegemma) - Open weights specialized for code infilling, natural language to code generation, and mathematical reasoning.
- [PaliGemma 2](https://ai.google.dev/gemma/docs/paligemma) - Vision-Language (VLM) foundation model designed for image captioning, visual question answering, text reading (OCR), and object detection.
- [RecurrentGemma](https://ai.google.dev/gemma/docs/recurrentgemma) - Efficient model architecture leveraging Griffin (recurrent neural networks + local attention) for low-memory, fast long-sequence generation.

---

## 🎨 Creative & Generative Media

### Image Generation & Editing
- [Imagen 3](https://deepmind.google/technologies/imagen-3/) - Google's highest-quality text-to-image model, offering superior detail, rich lighting, and legible typography in rendered assets.
- [ImageFX](https://aitestkitchen.withgoogle.com/tools/image-fx) - Interactive consumer playground powered by Imagen 3 featuring expressive "expressive chips" for prompt exploration.

### Video Generation
- [Google Veo](https://deepmind.google/technologies/veo/) - Generative high-definition 1080p video foundation model with cinematic camera controls (pan, zoom, tilt) and multi-clip visual continuity.
- [VideoFX](https://aitestkitchen.withgoogle.com/tools/video-fx) - Experimental tool for creators to prototype video storyboards and visual sequences with Veo.

### Audio, Speech & Music
- [MusicLM / Lyria](https://deepmind.google/discover/blog/transforming-the-future-of-music-creation/) - DeepMind's flagship music generation model creating layered melodies from text descriptions and humming inputs.
- [AudioLM](https://google-research.github.io/seanet/audiolm/examples/) - Pure audio language modeling framework synthesizing natural speech, ambient acoustics, and piano continuations.

### AI Watermarking & Provenance
- [SynthID](https://deepmind.google/technologies/synthid/) - Breakthrough digital watermarking technology that embeds invisible, cryptographically robust markers into AI-generated images, audio, video, and text without degrading quality.

---

## 🛠️ Developer Tools, SDKs & APIs

- [Google GenAI SDK (Python & TypeScript)](https://github.com/google-gemini) - The modern official developer client library for Gemini and Imagen models (`google-genai` and `@google/genai`).
- [Google AI Studio](https://aistudio.google.com/) - Web-based prototyping sandbox for testing system prompts, tuning parameters, and exporting API code snippets.
- [MediaPipe Solutions](https://developers.google.com/mediapipe) - Cross-platform on-device machine learning suite for mobile (Android/iOS), web (WebGPU), and IoT running Gemma, vision classifiers, and pose estimation.
- [TensorFlow](https://www.tensorflow.org/) & [JAX](https://github.com/google/jax) - Google's foundational high-performance numerical computing and differentiable programming frameworks for cutting-edge deep learning.

---

## 🤖 Autonomous Agents & Coding Tools

- [NotebookLM](https://notebooklm.google.com/) - Personalized AI research assistant grounded strictly in your uploaded documents, complete with citations and instant two-host **Audio Overviews**.
- [Google Antigravity](https://googleaitools.com/google-antigravity-review/) - High-tier agentic software engineering system capable of end-to-end plan execution, browser testing, and automated builds.
- [Project Jules](https://googleaitools.com/jules-google-ai-coding-agent-guide/) - Asynchronous coding agent that integrates with GitHub repositories to automatically solve bugs and generate verified Pull Requests.
- [Gemini Code Assist](https://cloud.google.com/products/gemini/code-assist) - Enterprise coding companion for IDEs (VS Code, JetBrains) providing code completion, security audits, and multi-file refactoring.

---

## ⚡ AI Infrastructure & Compute (TPUs)

- [Cloud TPU v5p & v5e](https://cloud.google.com/tpu) - Next-generation Tensor Processing Units engineered specifically for training and serving massive transformer models.
- [Trillium (6th Gen TPU)](https://cloud.google.com/blog/products/compute/introducing-trillium-6th-gen-tpu) - Delivers a 4.7x increase in peak compute performance per chip over TPU v5e with doubled high-bandwidth memory (HBM).

---

## 📚 Tutorials, Guides & Deep Dives

For step-by-step implementations and real-world architectures, visit **[googleaitools.com](https://googleaitools.com)**:

- 🚀 [Getting Started with Gemini 1.5 Pro: The 2M Token Revolution](https://googleaitools.com/getting-started-with-gemini-1-5-pro/)
- ⚡ [How to Build Real-Time Apps with Gemini 1.5 Flash](https://googleaitools.com/how-to-use-gemini-15-flash/)
- 🎙️ [NotebookLM Complete Guide: Audio Overviews & Literature Synthesis](https://googleaitools.com/notebooklm-ai-research-guide/)
- 🎨 [Imagen 3 Prompt Engineering Masterclass](https://googleaitools.com/imagen-3-prompt-engineering-tips/)
- 🎥 [Google Veo Cinematic Video Generation Tutorial](https://googleaitools.com/google-veo-video-generation-tutorial/)
- 💻 [Deploying Gemma 2 Locally with Ollama and HuggingFace](https://googleaitools.com/gemma-open-source-ai-models-guide/)

---

## 🤝 Contributing

Contributions are welcome! Please read our [Contribution Guidelines](CONTRIBUTING.md) before submitting a Pull Request.

1. Fork the repository
2. Create your branch (`git checkout -b feature/add-new-tool`)
3. Commit your changes with clear descriptions
4. Push to your branch and open a Pull Request

---

## ⚖️ License

[![CC0](https://licensebuttons.net/p/zero/1.0/88x31.png)](https://creativecommons.org/publicdomain/zero/1.0/)

To the extent possible under law, the maintainers of [googleaitools.com](https://googleaitools.com) have waived all copyright and related or neighboring rights to this repository under the **Creative Commons CC0 1.0 Universal Public Domain Dedication**.
