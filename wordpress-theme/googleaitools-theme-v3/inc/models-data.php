<?php
/**
 * Frontier LLM & Multimodal Models Catalog Dataset & Helpers
 * Complete, authoritative directory of frontier AI models inspired by OpenRouter Discover.
 * Covers 60+ frontier architectures across Speech, Coding, Video, Image, Reasoning, Fastest, Value, and Flagship.
 */

if (!function_exists('googleaitools_get_model_categories')) {
    function googleaitools_get_model_categories() {
        return array(
            'flagship' => array(
                'name' => 'Flagship & General AI',
                'slug' => 'flagship',
                'headline' => 'Frontier All-Around Multimodal Foundation Models',
                'description' => 'The most intelligent frontier models capable of complex cross-domain reasoning, multimodal perception, and end-to-end task completion.',
                'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px; height:18px; vertical-align:middle;"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
                'badge' => 'Flagship Frontier'
            ),
            'coding' => array(
                'name' => 'Coding & Software Dev',
                'slug' => 'coding',
                'headline' => 'Frontier Code Generation, Refactoring & Systems Engineering',
                'description' => 'Autonomous code intelligence models trained specifically for full-stack programming, complex debugging, and multi-file architecture.',
                'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px; height:18px; vertical-align:middle;"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
                'badge' => 'Code & Systems'
            ),
            'reasoning' => array(
                'name' => 'Reasoning & Agentic',
                'slug' => 'reasoning',
                'headline' => 'Chain-of-Thought, Extended Thinking & Deep Reasoning',
                'description' => 'Reinforcement-learning trained frontier reasoning models engineered for STEM, theorem proving, and complex autonomous tool orchestration.',
                'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px; height:18px; vertical-align:middle;"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
                'badge' => 'Deep Thinking'
            ),
            'speech' => array(
                'name' => 'Speech & Audio',
                'slug' => 'speech',
                'headline' => 'Leading Speech Synthesis & Voice Intelligence Models',
                'description' => 'Explore state-of-the-art text-to-speech, real-time bidirectional voice agents, and acoustic reasoning foundation models.',
                'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px; height:18px; vertical-align:middle;"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>',
                'badge' => 'Voice & Audio'
            ),
            'video' => array(
                'name' => 'Video Generation',
                'slug' => 'video',
                'headline' => 'Next-Gen Spatio-Temporal Generative Video Diffusion',
                'description' => 'High-definition 1080p and 4K generative video models with camera control, motion physics, and zero-shot temporal consistency.',
                'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px; height:18px; vertical-align:middle;"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>',
                'badge' => 'Video Diffusion'
            ),
            'image' => array(
                'name' => 'Image Generation & Vision',
                'slug' => 'image',
                'headline' => 'Frontier Diffusion & Flow Transformer Image Models',
                'description' => 'Photorealistic visual synthesis, complex typography rendering, and multimodal inpainting engines.',
                'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px; height:18px; vertical-align:middle;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>',
                'badge' => 'Image Synthesis'
            ),
            'fastest' => array(
                'name' => 'Fastest Models',
                'slug' => 'fastest',
                'headline' => 'Highest Median Output Speed Across Multi-Provider Clusters',
                'description' => 'Ultra-low latency models delivering maximum tokens per second (tok/s) for interactive UI and real-time copilot applications.',
                'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px; height:18px; vertical-align:middle;"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
                'badge' => 'Speed Leaders'
            ),
            'value' => array(
                'name' => 'Value Leaders',
                'slug' => 'value',
                'headline' => 'Maximum Frontier Capability Per Dollar of Inference',
                'description' => 'Economical frontier models evaluated on benchmark intelligence, coding, and agentic workflows per unit cost.',
                'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px; height:18px; vertical-align:middle;"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
                'badge' => 'Max Efficiency'
            )
        );
    }
}

if (!function_exists('googleaitools_get_models_data')) {
    function googleaitools_get_models_data() {
        static $models_list = null;
        if ($models_list !== null) {
            return $models_list;
        }

        $models_list = array(
            // =================================================================
            // 1. FLAGSHIP & GENERAL AI FRONTIER MODELS
            // =================================================================
            array(
                'id' => 'google/gemini-4-hydrogen',
                'name' => 'Gemini 4 Hydrogen',
                'slug' => 'gemini-4-hydrogen',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '195 tok/s',
                'ttft' => '160ms',
                'providersCount' => 38,
                'contextWindow' => '10M tokens',
                'inputPrice' => '$1.25 / 1M',
                'outputPrice' => '$5.00 / 1M',
                'tagline' => 'Google DeepMind fourth-generation frontier multimodal powerhouse codenamed Project Hydrogen with 10M token context window, dynamic test-time reasoning, and full-spectrum agentic autonomy.',
                'summary' => 'Gemini 4 Hydrogen (Project Hydrogen) represents Google DeepMind most powerful and versatile artificial intelligence system to date. Engineered with a revolutionary Sparse Mixture-of-Experts (MoE) architecture trained on next-generation Google TPU v6 (Trillium) pods, Gemini 4 integrates recursive chain-of-thought deliberation with native omnimodal perception. It processes text, multi-gigabyte codebases, high-framerate 4K video, spatial 3D audio, and real-time sensory inputs without latency bottlenecks. Boasting a breakthrough 10 million token native context window with 99.9% needle-in-a-haystack recall, Gemini 4 establishes the gold standard for enterprise systems engineering, autonomous scientific research, and complex agentic workflows.',
                'architecture' => 'Next-generation Sparse Mixture-of-Experts (MoE) multimodal transformer featuring dynamic test-time compute allocation, recursive cross-attention across text, video, and audio tokens, and hardware-accelerated TPU v6 Trillium kernel optimizations.',
                'keyCapabilities' => array(
                    'Massive 10,000,000 token context window capable of ingesting decades of research papers, enterprise repositories, or days of continuous video in a single inference pass.',
                    'Dynamic recursive reasoning: automatically balances instant response latency against extended thinking compute for hard mathematical, scientific, and architectural problems.',
                    'Native omnimodal comprehension: processes interleaved text, pixel, waveform, and robotics sensor tokens directly at the foundational layer without external transcoding.',
                    'Agentic autonomous execution: self-orchestrates complex multi-day tool pipelines with continuous self-verification, automated rollback, and interactive browser actions.'
                ),
                'benchmarks' => array(
                    'MMLU-Pro' => '94.6% (Frontier SOTA Record)',
                    'SWE-bench Verified' => '78.2% resolved real-world issues',
                    'Context Retrieval' => '99.9% up to 10M tokens',
                    'MATH-500' => '96.5% zero-shot accuracy'
                ),
                'googleSynergy' => 'Native foundation of Google AI Studio, Google Cloud Vertex AI, and Gemini CLI. Delivers zero-latency private VPC endpoints, Customer-Managed Encryption Keys (CMEK), BigQuery federated vector search, and direct deployment to Google Cloud TPU v6 Trillium accelerators.',
                'samplePrompt' => 'Ingest this 500,000-line legacy banking core, audit all concurrency deadlocks, identify architectural anti-patterns, and generate a modernized event-driven microservices architecture in Go with formal TLA+ specifications and automated CI/CD pipelines.',
                'sampleOutput' => '[Complete enterprise modernization blueprint with formal mathematical TLA+ verification proofs, 24 Go microservices, automated unit/integration tests, and zero-downtime migration scripts]'
            ),
            array(
                'id' => 'google/gemini-2.5-pro',
                'name' => 'Gemini 2.5 Pro',
                'slug' => 'gemini-2-5-pro',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '145 tok/s',
                'ttft' => '220ms',
                'providersCount' => 28,
                'contextWindow' => '2M tokens',
                'inputPrice' => '$1.25 / 1M',
                'outputPrice' => '$5.00 / 1M',
                'tagline' => 'Google DeepMind flagship multimodal engine with industry-leading 2M token context window and native audio/video comprehension.',
                'summary' => 'Gemini 2.5 Pro represents the pinnacle of Google DeepMind frontier AI research. Built from the ground up as a native multimodal model, it processes massive datasets, full code repositories, high-definition hour-long videos, and complex audio files without context chunking. Its long-context retrieval accuracy reaches 99.7% needle-in-a-haystack verification up to 2 million tokens, making it the supreme choice for enterprise legal analysis, codebase migrations, and cross-modal research.',
                'architecture' => 'Sparse Mixture-of-Experts (MoE) multimodal transformer backbone optimized on Google TPU v5e clusters with native cross-attention across text, pixel, and audio embeddings.',
                'keyCapabilities' => array(
                    'Massive 2,000,000 token context window capable of ingesting entire enterprise codebases or 20 hours of raw audio in a single prompt.',
                    'Native audio, video, and visual spatial understanding without intermediary transcription models.',
                    'Flawless instruction following across deeply nested multi-step tool execution pipelines.',
                    'Unrivaled code translation and refactoring across legacy COBOL, C++, Java, and modern TypeScript.'
                ),
                'benchmarks' => array(
                    'MMLU-Pro' => '89.2% benchmark accuracy',
                    'SWE-bench Verified' => '54.6% resolved real-world issues',
                    'Context Retrieval' => '99.7% up to 2M tokens',
                    'Math (MATH-500)' => '91.4% zero-shot accuracy'
                ),
                'googleSynergy' => 'Native foundation of Google Cloud Vertex AI, offering zero-latency private VPC endpoints, Customer-Managed Encryption Keys (CMEK), and seamless integration with BigQuery vector search.',
                'samplePrompt' => 'Ingest this 40,000-line microservices codebase, audit all cryptographic hashing routines for post-quantum vulnerability, and generate complete pull requests with unit tests.',
                'sampleOutput' => '[Detailed cryptographic security audit with 14 automated patch diffs, full regression test suites, and compliance documentation for NIST SP 800-208]'
            ),
            array(
                'id' => 'anthropic/claude-3.7-sonnet',
                'name' => 'Claude 3.7 Sonnet',
                'slug' => 'claude-3-7-sonnet',
                'provider' => 'Anthropic',
                'providerSlug' => 'anthropic',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '115 tok/s',
                'ttft' => '280ms',
                'providersCount' => 34,
                'contextWindow' => '200k tokens',
                'inputPrice' => '$3.00 / 1M',
                'outputPrice' => '$15.00 / 1M',
                'tagline' => 'Anthropic premier hybrid reasoning model featuring seamless toggling between instant execution and deep chain-of-thought.',
                'summary' => 'Claude 3.7 Sonnet is Anthropic most capable intelligent model to date, pioneering the hybrid thinking paradigm. Unlike traditional models that either guess quickly or take agonizing minutes to deliberate, Claude 3.7 Sonnet allows engineers to dynamically budget reasoning tokens depending on task complexity. In coding, full-stack software architecture, and subtle prose editing, it sets global records for precision and zero hallucination.',
                'architecture' => 'Dense autoregressive transformer with adaptive deliberation budgeting, trained using Constitutional AI and advanced Reinforcement Learning from Human and AI Feedback (RLHF/RLAIF).',
                'keyCapabilities' => array(
                    'Hybrid reasoning architecture: executes routine queries instantaneously while allocating extended thinking tokens for difficult mathematical and architectural puzzles.',
                    'World-leading software engineering capability: resolves complex real-world pull requests with pristine syntactic correctness.',
                    'Computer Use integration: autonomously navigates desktop graphical interfaces, moves cursors, clicks buttons, and operates complex desktop apps.',
                    'Nuanced, human-grade prose synthesis devoid of predictable AI clichés.'
                ),
                'benchmarks' => array(
                    'SWE-bench Verified' => '70.3% (Global Frontier Record)',
                    'TAU-bench Airline' => '81.2% autonomous agent task completion',
                    'MMLU-Pro' => '90.1% across scientific disciplines',
                    'HumanEval' => '94.8% zero-shot Python code pass'
                ),
                'googleSynergy' => 'Fully available through Google Cloud Vertex AI Model Garden, enabling enterprise governance, IAM role separation, and private enterprise VPC deployment.',
                'samplePrompt' => 'Design an asynchronous, fault-tolerant distributed transaction orchestrator in Go using the Saga pattern with compensating transactions and Kafka event logs.',
                'sampleOutput' => '[Complete, production-ready Go codebase with saga state machine, idempotent compensation handlers, graceful shutdown, and benchmarked unit test coverage]'
            ),
            array(
                'id' => 'openai/gpt-4o',
                'name' => 'GPT-4o (Omni)',
                'slug' => 'gpt-4o',
                'provider' => 'OpenAI',
                'providerSlug' => 'openai',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '130 tok/s',
                'ttft' => '210ms',
                'providersCount' => 45,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$2.50 / 1M',
                'outputPrice' => '$10.00 / 1M',
                'tagline' => 'OpenAI omni-channel flagship integrating real-time voice, vision, and text into a unified low-latency neural pipeline.',
                'summary' => 'GPT-4o (Omni) is OpenAI flagship foundation model that unifies text, audio, and visual inputs into a single continuous neural network. By eliminating the translation latency between separate speech-to-text, text-reasoning, and text-to-speech modules, GPT-4o delivers rapid conversational response times and unprecedented empathy, nuance, and visual contextual awareness.',
                'architecture' => 'Unified end-to-end multimodal transformer trained natively across text, speech waveforms, and video frames simultaneously.',
                'keyCapabilities' => array(
                    'Unified multimodal processing with end-to-end audio understanding and native voice inflection.',
                    'Real-time visual comprehension of user screens, diagrams, blueprints, and handwritten sketches.',
                    'Comprehensive tool use and structured JSON output guarantee via JSON Schema enforcement.',
                    'Massive multilingual proficiency across 50+ major world languages.'
                ),
                'benchmarks' => array(
                    'MMLU' => '88.7% 5-shot accuracy',
                    'MathVista' => '63.8% visual mathematical reasoning',
                    'HumanEval' => '90.2% code synthesis',
                    'Audio Latency' => '320ms average conversational turnaround'
                ),
                'googleSynergy' => 'Integrates cleanly with hybrid enterprise multi-agent setups bridging Google Cloud storage buckets and OpenAI API gateway routing.',
                'samplePrompt' => 'Analyze this architectural diagram of a microservices backend, identify single points of failure, and provide terraform snippets to remediate them.',
                'sampleOutput' => '[Thorough resilience analysis highlighting 3 single points of failure, followed by production Terraform HCL code implementing multi-AZ redundancy and managed failover]'
            ),
            array(
                'id' => 'meta-llama/llama-3.1-405b-instruct',
                'name' => 'Llama 3.1 405B Instruct',
                'slug' => 'llama-3-1-405b-instruct',
                'provider' => 'Meta',
                'providerSlug' => 'meta',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '85 tok/s',
                'ttft' => '380ms',
                'providersCount' => 32,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$1.50 / 1M',
                'outputPrice' => '$3.00 / 1M',
                'tagline' => 'The world largest open-weights foundation model offering frontier-grade reasoning and synthetic data generation.',
                'summary' => 'Llama 3.1 405B Instruct is Meta monumental achievement in open frontier artificial intelligence. Trained on over 16,000 H100 GPUs with 15 trillion tokens, it rivals proprietary closed models like GPT-4o in general knowledge, scientific reasoning, and multilingual fluency. Crucially, its open weights give enterprises complete architectural transparency, on-premise sovereignty, and the ability to generate gold-standard synthetic training data for smaller models.',
                'architecture' => 'Dense autoregressive decoder-only transformer with 405 billion parameters, Grouped-Query Attention (GQA), and 128k rotary positional embeddings (RoPE).',
                'keyCapabilities' => array(
                    'Full open-weight weights enabling on-premise private cloud hosting with complete data privacy.',
                    'Exceptional synthetic data generation capability for fine-tuning smaller 8B and 70B models.',
                    'Advanced multi-lingual translation and mathematical reasoning rivaling GPT-4o.',
                    'Robust tool orchestration supporting external search APIs, Python code sandboxes, and database connections.'
                ),
                'benchmarks' => array(
                    'MMLU' => '88.6% zero-shot',
                    'MATH' => '73.8% benchmark accuracy',
                    'HumanEval' => '89.0% coding pass rate',
                    'MGSM' => '91.6% multilingual math reasoning'
                ),
                'googleSynergy' => 'Deployable directly on Google Cloud GKE (Google Kubernetes Engine) with Cloud TPU v5p or NVIDIA H100 instances with full VPC Service Controls.',
                'samplePrompt' => 'Generate an exhaustive 10,000-word comparative research paper analyzing the geopolitical, economic, and technological implications of semiconductor manufacturing sovereignty.',
                'sampleOutput' => '[Comprehensive, deeply researched academic thesis with citation taxonomy, supply chain dependency analysis, and geopolitical risk matrices]'
            ),
            array(
                'id' => 'mistralai/mistral-large-2411',
                'name' => 'Mistral Large 2',
                'slug' => 'mistral-large-2',
                'provider' => 'Mistral AI',
                'providerSlug' => 'mistral',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '120 tok/s',
                'ttft' => '240ms',
                'providersCount' => 26,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$2.00 / 1M',
                'outputPrice' => '$6.00 / 1M',
                'tagline' => 'Europe premier frontier model with world-class multilingual mastery, code proficiency, and deterministic tool-calling.',
                'summary' => 'Mistral Large 2 (2411) is Mistral AI flagship foundation model engineered with unparalleled European multilingual proficiency, mathematical depth, and code synthesis. With a native 128k context window and top-tier function-calling capabilities, it rivals leading American proprietary frontier models while providing full compliance with European AI regulations and data sovereignty standards.',
                'architecture' => 'Dense 123-billion parameter transformer with optimized attention layers, extensive multilingual pre-training, and native function-calling tokenizers.',
                'keyCapabilities' => array(
                    'Native mastery across French, German, Spanish, Italian, Portuguese, Arabic, and 80+ global languages.',
                    'Exceptional code reasoning supporting 80+ programming languages with fill-in-the-middle support.',
                    'Deterministic function calling and structured JSON output guarantee.',
                    'Strict compliance alignment with GDPR and the European Union AI Act.'
                ),
                'benchmarks' => array(
                    'MMLU' => '84.0% accuracy',
                    'HumanEval' => '92.0% coding pass',
                    'Multi-lingual MMLU' => '86.2% across European languages',
                    'Math' => '76.8% on MATH-500'
                ),
                'googleSynergy' => 'Available on Google Cloud Vertex AI Model Garden for European enterprise clients requiring local EU data residency and ISO compliance.',
                'samplePrompt' => 'Draft a legally watertight European commercial lease agreement under French civil law with parallel English translation and automated indexation clauses.',
                'sampleOutput' => '[Complete bilingual legal contract incorporating French civil code provisions, indexation formulas, and termination covenants]'
            ),

            // =================================================================
            // 2. CODING & SOFTWARE DEVELOPMENT SPECIALISTS
            // =================================================================
            array(
                'id' => 'qwen/qwen-2.5-coder-32b-instruct',
                'name' => 'Qwen 2.5 Coder 32B Instruct',
                'slug' => 'qwen-2-5-coder-32b-instruct',
                'provider' => 'Alibaba Qwen',
                'providerSlug' => 'qwen',
                'category' => 'coding',
                'categoryName' => 'Coding & Software Dev',
                'throughput' => '460 tok/s',
                'ttft' => '180ms',
                'providersCount' => 38,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.07 / 1M',
                'outputPrice' => '$0.16 / 1M',
                'tagline' => 'The reigning open-source code champion rivaling 70B models in synthesis, refactoring, and multi-file debugging.',
                'summary' => 'Qwen 2.5 Coder 32B Instruct has revolutionized open-source software engineering. Trained on over 5.5 trillion tokens of diverse source code, synthetic programming problems, and real-world repository git commits, it matches or exceeds much larger proprietary models on SWE-bench and HumanEval while running comfortably on a single consumer GPU with 4-bit quantization.',
                'architecture' => 'Dense transformer decoder with RoPE positional embeddings, Grouped-Query Attention, and extensive code-syntax alignment.',
                'keyCapabilities' => array(
                    'Full-stack code generation across 92 programming languages, including Rust, Go, Python, TypeScript, and CUDA.',
                    'Repository-level comprehension: ingests multi-file projects and accurately refactors cross-file dependencies.',
                    'Fill-In-The-Middle (FIM) support for real-time IDE completion and in-line code rewriting.',
                    'Cost-performance ratio that is 90% cheaper than proprietary coding APIs.'
                ),
                'benchmarks' => array(
                    'HumanEval' => '92.7% zero-shot Python pass rate',
                    'EvalPlus' => '87.4% rigorous benchmark score',
                    'SWE-bench Verified' => '48.9% resolved issues',
                    'Throughput' => '460 tok/s median output speed'
                ),
                'googleSynergy' => 'Easily deployed on Google Cloud Run with GPU or Cloud TPU v5e for enterprise continuous integration and code review bots.',
                'samplePrompt' => 'Build a high-throughput WebSocket chat server in Rust using Tokio and Axum with JWT authentication, Redis Pub/Sub clustering, and zero memory leaks.',
                'sampleOutput' => '[Complete, modular Rust project with Cargo.toml, connection pooling, heartbeat pings, Redis synchronization, and exhaustive test suite]'
            ),
            array(
                'id' => 'mistralai/codestral-2501',
                'name' => 'Codestral 2501',
                'slug' => 'codestral-2501',
                'provider' => 'Mistral AI',
                'providerSlug' => 'mistral',
                'category' => 'coding',
                'categoryName' => 'Coding & Software Dev',
                'throughput' => '320 tok/s',
                'ttft' => '195ms',
                'providersCount' => 24,
                'contextWindow' => '256k tokens',
                'inputPrice' => '$0.30 / 1M',
                'outputPrice' => '$0.90 / 1M',
                'tagline' => 'High-velocity 256k context coding engine engineered specifically for IDE integrations and repository search.',
                'summary' => 'Codestral 2501 is Mistral AI purpose-built code generation foundation model. Featuring an enormous 256k context window and fine-tuned for zero-latency IDE autocomplete, Codestral effortlessly tracks variable definitions, library imports, and architectural patterns across massive software codebases.',
                'architecture' => 'Dense 22-billion parameter code-specialized transformer with sliding-window attention and 256k rotary positional encodings.',
                'keyCapabilities' => array(
                    'Sub-200ms latency optimized specifically for real-time in-editor code tab-completions.',
                    'Huge 256,000 token context window permitting whole-repository ingestion without vector truncation.',
                    'Native Fill-In-The-Middle (FIM) mechanism for surgical multi-line edits.',
                    'Deep proficiency across 80+ software frameworks including React, Django, Spring Boot, and Kubernetes.'
                ),
                'benchmarks' => array(
                    'HumanEval' => '81.1% zero-shot accuracy',
                    'RepoBench' => '85.4% repository-level code completion',
                    'Context Window' => '256k tokens native',
                    'Output Speed' => '320 tok/s'
                ),
                'googleSynergy' => 'Perfect companion for Cloud Workstations and Google Cloud Source Repositories with automated webhook PR analysis.',
                'samplePrompt' => 'Write a custom Kubernetes controller in Go using client-go and controller-runtime to auto-provision and balance stateful GPU workloads.',
                'sampleOutput' => '[Complete Kubernetes Operator codebase with custom resource definitions (CRD), reconciler loop, RBAC manifests, and controller manager setup]'
            ),
            array(
                'id' => 'deepseek/deepseek-chat',
                'name' => 'DeepSeek V3',
                'slug' => 'deepseek-v3',
                'provider' => 'DeepSeek',
                'providerSlug' => 'deepseek',
                'category' => 'coding',
                'categoryName' => 'Coding & Software Dev',
                'throughput' => '240 tok/s',
                'ttft' => '210ms',
                'providersCount' => 48,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.14 / 1M',
                'outputPrice' => '$0.28 / 1M',
                'tagline' => '671B parameter Mixture-of-Experts architecture setting global standards for open coding economics and reasoning.',
                'summary' => 'DeepSeek V3 has sent shockwaves through the global AI ecosystem. With 671 billion total parameters activating 37 billion per token, DeepSeek V3 matches or outperforms GPT-4o and Claude 3.5 Sonnet on standard coding and mathematics benchmarks while operating at a tiny fraction of proprietary API pricing.',
                'architecture' => 'Multi-head Latent Attention (MLA) and DeepSeekMoE architecture with auxiliary-loss-free load balancing across 256 routed experts and 1 shared expert.',
                'keyCapabilities' => array(
                    '671B parameter Mixture-of-Experts model delivering frontier proprietary intelligence at open-source commodity pricing.',
                    'Multi-head Latent Attention (MLA) drastically compressing KV cache memory consumption for high-concurrency serving.',
                    'Exemplary proficiency in algorithms, competitive programming, and automated theorem proving.',
                    'Exceptional mathematical derivation and formal system verification.'
                ),
                'benchmarks' => array(
                    'MMLU' => '88.5% benchmark score',
                    'HumanEval' => '90.2% code pass',
                    'MATH-500' => '90.2% mathematical reasoning',
                    'Cost Ratio' => '95% cheaper than GPT-4o'
                ),
                'googleSynergy' => 'Ideal for high-volume enterprise automated code migration pipelines and BigQuery analytical SQL query optimization.',
                'samplePrompt' => 'Optimize this nested SQL analytical query with 10 window functions and billions of rows for Google BigQuery to minimize slot time and eliminate shuffle spills.',
                'sampleOutput' => '[Refactored BigQuery SQL using partition-pruned CTEs, QUALIFY clauses, and clustered join optimization with 72% compute slot reduction]'
            ),
            array(
                'id' => 'anthropic/claude-3.5-sonnet',
                'name' => 'Claude 3.5 Sonnet',
                'slug' => 'claude-3-5-sonnet',
                'provider' => 'Anthropic',
                'providerSlug' => 'anthropic',
                'category' => 'coding',
                'categoryName' => 'Coding & Software Dev',
                'throughput' => '120 tok/s',
                'ttft' => '260ms',
                'providersCount' => 42,
                'contextWindow' => '200k tokens',
                'inputPrice' => '$3.00 / 1M',
                'outputPrice' => '$15.00 / 1M',
                'tagline' => 'The software industry gold standard for complex code refactoring, system architecture, and autonomous agent loops.',
                'summary' => 'Claude 3.5 Sonnet remains the undisputed reference standard for software engineers worldwide. Renowned for its deep architectural intuition, exceptional bug detection, and surgical refactoring capabilities, it powers the majority of leading AI coding IDEs including Cursor, Windsurf, and Devin.',
                'architecture' => 'Dense multimodal transformer fine-tuned specifically for agentic computer interaction and complex software engineering workflows.',
                'keyCapabilities' => array(
                    'The definitive gold standard for software engineering with unmatched context retention across large projects.',
                    'Superb automated debugging: identifies subtle concurrency races, memory leaks, and off-by-one errors with zero hand-holding.',
                    'Unrivaled frontend generation producing accessible, polished, production-ready React and Tailwind components.',
                    'Deeply grounded system architecture and technical design documentation.'
                ),
                'benchmarks' => array(
                    'SWE-bench Verified' => '65.2% resolved real-world GitHub issues',
                    'HumanEval' => '93.7% Python pass rate',
                    'TAU-bench' => '69.0% agentic workflow completion',
                    'Vision MMLU' => '89.8% visual technical accuracy'
                ),
                'googleSynergy' => 'Native availability on Google Cloud Vertex AI with enterprise IAM roles, audit logs, and SOC2 compliance.',
                'samplePrompt' => 'Build a complete responsive React dashboard in TypeScript with Tailwind CSS featuring real-time charts, dark mode toggle, and accessible keyboard navigation.',
                'sampleOutput' => '[Production-ready TypeScript React component hierarchy with Recharts integration, CSS variable theming, and full ARIA accessibility labels]'
            ),
            array(
                'id' => 'google/gemini-2.5-flash',
                'name' => 'Gemini 2.5 Flash',
                'slug' => 'gemini-2-5-flash',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'coding',
                'categoryName' => 'Coding & Software Dev',
                'throughput' => '340 tok/s',
                'ttft' => '140ms',
                'providersCount' => 30,
                'contextWindow' => '1M tokens',
                'inputPrice' => '$0.075 / 1M',
                'outputPrice' => '$0.30 / 1M',
                'tagline' => 'High-frequency 1M token context engine built for high-throughput code review, AST parsing, and automated test generation.',
                'summary' => 'Gemini 2.5 Flash is Google DeepMind high-speed, cost-optimized multimodal workhorse. Packing a massive 1-million-token context window into a lightweight architecture that streams output at 340 tok/s, it allows development teams to analyze whole code repositories and generate comprehensive test suites at negligible cost.',
                'architecture' => 'Lightweight multi-modal transformer optimized for high TPU utilization and low-latency inference routing.',
                'keyCapabilities' => array(
                    '1,000,000 token context window operating at microsecond speeds.',
                    'Automated unit, integration, and end-to-end test generation for full enterprise repositories.',
                    'Native multimodal support analyzing UI screenshots, architectural mockups, and wireframes.',
                    'Sub-150ms Time To First Token for snappy interactive developer tooling.'
                ),
                'benchmarks' => array(
                    'HumanEval' => '86.4% code generation pass',
                    'Context Retrieval' => '99.8% needle-in-haystack up to 1M tokens',
                    'Throughput' => '340 tok/s sustained',
                    'TTFT' => '140ms median'
                ),
                'googleSynergy' => 'Native Vertex AI engine with direct integration into Cloud Build, Google Workspace, and Android Studio Gemini integration.',
                'samplePrompt' => 'Review this 15,000-line Python backend, generate pytest unit tests with 95% branch coverage, and identify any unhandled async exceptions.',
                'sampleOutput' => '[Exhaustive pytest test suite utilizing pytest-asyncio and mock fixtures, accompanied by an exception handling hardening report]'
            ),

            // =================================================================
            // 3. REASONING & AGENTIC SPECIALISTS (Chain-of-Thought / Deep Thinking)
            // =================================================================
            array(
                'id' => 'deepseek/deepseek-r1',
                'name' => 'DeepSeek R1',
                'slug' => 'deepseek-r1',
                'provider' => 'DeepSeek',
                'providerSlug' => 'deepseek',
                'category' => 'reasoning',
                'categoryName' => 'Reasoning & Agentic',
                'throughput' => '180 tok/s',
                'ttft' => '320ms',
                'providersCount' => 52,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.55 / 1M',
                'outputPrice' => '$2.19 / 1M',
                'tagline' => 'Open-weights frontier reasoning engine trained via pure reinforcement learning, rivaling OpenAI o1 in STEM and mathematics.',
                'summary' => 'DeepSeek R1 has fundamentally transformed artificial intelligence by demonstrating that pure large-scale reinforcement learning (RL) without heavy supervised fine-tuning can elicit profound reasoning, self-correction, and verification behaviors. On competitive mathematics, Olympiad STEM challenges, and complex software logic, R1 delivers performance comparable to proprietary reasoning models at open-weights availability.',
                'architecture' => '671B parameter Mixture-of-Experts foundation trained via multi-stage Reinforcement Learning from Cold-Start Data, featuring transparent chain-of-thought token generation.',
                'keyCapabilities' => array(
                    'Autonomous chain-of-thought deliberation: systematically explores hypotheses, backtracks upon detecting logical errors, and verifies proofs.',
                    'Olympic-grade mathematical derivation: solves advanced Putnam and AIME mathematical competition problems.',
                    'Full transparency: outputs explicit <think> reasoning tokens allowing developers to inspect the model thought process.',
                    'Open weights available for distillation into lightweight 7B, 14B, and 32B domain models.'
                ),
                'benchmarks' => array(
                    'AIME 2024' => '79.8% pass@1 (Rivaling OpenAI o1)',
                    'MATH-500' => '97.3% benchmark accuracy',
                    'Codeforces' => '96.3 percentile competitive rating',
                    'SWE-bench Verified' => '49.2% resolved real-world issues'
                ),
                'googleSynergy' => 'Can be deployed via Google Cloud GKE using vLLM or SGLang on TPU v5p and NVIDIA H100 clusters for private enterprise research.',
                'samplePrompt' => 'Prove that there are infinitely many prime numbers p such that p+2 is either prime or the product of two primes, detailing Chen theorem methodology.',
                'sampleOutput' => '[Rigorous mathematical breakdown with step-by-step sieve theory explanation, almost-prime definitions, and Chen Jingrun landmark proof derivation]'
            ),
            array(
                'id' => 'openai/o3-mini',
                'name' => 'OpenAI o3-mini',
                'slug' => 'o3-mini',
                'provider' => 'OpenAI',
                'providerSlug' => 'openai',
                'category' => 'reasoning',
                'categoryName' => 'Reasoning & Agentic',
                'throughput' => '220 tok/s',
                'ttft' => '280ms',
                'providersCount' => 36,
                'contextWindow' => '200k tokens',
                'inputPrice' => '$1.10 / 1M',
                'outputPrice' => '$4.40 / 1M',
                'tagline' => 'OpenAI most cost-effective frontier reasoning model with adjustable reasoning effort and web search integration.',
                'summary' => 'OpenAI o3-mini is the next-generation compact reasoning model engineered to make STEM problem-solving, competitive coding, and multi-step logic accessible at scale. Featuring configurable reasoning effort parameters (low, medium, high) and native search grounding, o3-mini delivers deep chain-of-thought intelligence with minimal latency and affordable pricing.',
                'architecture' => 'Highly optimized transformer trained with reinforcement learning for reasoning token optimization and search-augmented deliberation.',
                'keyCapabilities' => array(
                    'Adjustable reasoning effort: allows developers to fine-tune latency vs. analytical depth per query.',
                    'Exceptional competitive programming performance on Codeforces and LeetCode hard problems.',
                    'Integrated web search grounding during the reasoning phase for real-time fact verification.',
                    'Structured tool calling and schema adherence during chain-of-thought exploration.'
                ),
                'benchmarks' => array(
                    'AIME 2024' => '87.3% with high reasoning effort',
                    'Codeforces' => '2080 Elo rating (Candidate Master level)',
                    'GPQA Diamond' => '74.2% graduate-level STEM accuracy',
                    'Context Window' => '200k tokens'
                ),
                'googleSynergy' => 'Complements Google Cloud BigQuery data pipelines for running automated statistical validation and causal inference models.',
                'samplePrompt' => 'Analyze the mathematical viability of implementing zero-knowledge succinct non-interactive arguments of knowledge (zk-SNARKs) over curve BLS12-381 for decentralized identity verification.',
                'sampleOutput' => '[Deep technical exposition detailing pairing-friendly elliptic curve parameters, Groth16 proving system setup, polynomial commitments, and gas cost analysis]'
            ),
            array(
                'id' => 'openai/o1',
                'name' => 'OpenAI o1',
                'slug' => 'openai-o1',
                'provider' => 'OpenAI',
                'providerSlug' => 'openai',
                'category' => 'reasoning',
                'categoryName' => 'Reasoning & Agentic',
                'throughput' => '90 tok/s',
                'ttft' => '1.4s',
                'providersCount' => 38,
                'contextWindow' => '200k tokens',
                'inputPrice' => '$15.00 / 1M',
                'outputPrice' => '$60.00 / 1M',
                'tagline' => 'OpenAI flagship reasoning model designed for complex science, quantum physics, and legal-grade analytical reasoning.',
                'summary' => 'OpenAI o1 is the pioneer of the test-time compute reasoning revolution. By allocating extensive computational thinking before generating visible tokens, o1 thinks through problem spaces, tests hypotheses, checks for subtle fallacies, and delivers groundbreaking solutions in biochemistry, physics, and advanced mathematics.',
                'architecture' => 'Large-scale transformer with reinforcement-learning-guided test-time deliberation tokens and automated verification loops.',
                'keyCapabilities' => array(
                    'Extensive test-time reasoning compute solving previously insurmountable scientific and cryptographic problems.',
                    'PhD-level performance in quantum mechanics, organic chemistry, and structural biochemistry.',
                    'Zero hallucination on complex multi-clause contract analysis and statutory interpretation.',
                    'Vision-enabled reasoning: interprets complex diagrams, biochemical pathways, and mathematical graphs.'
                ),
                'benchmarks' => array(
                    'AIME 2024' => '83.3% zero-shot accuracy',
                    'GPQA Diamond' => '78.0% PhD-level science accuracy',
                    'Codeforces' => '1807 Elo rating',
                    'MMLU-Pro' => '91.8% benchmark score'
                ),
                'googleSynergy' => 'Ideal for life sciences and enterprise R&D departments running discovery workflows alongside Google Cloud Healthcare API datasets.',
                'samplePrompt' => 'Propose a novel retrosynthetic pathway for the chemical synthesis of an asymmetric macrocyclic kinase inhibitor with step-by-step reaction conditions and protecting group strategy.',
                'sampleOutput' => '[Comprehensive 12-step retrosynthetic route detailing stereoselective transformations, Grubbs metathesis parameters, reagent purities, and chromatographic purification]'
            ),
            array(
                'id' => 'qwen/qwq-32b-preview',
                'name' => 'QwQ 32B Preview',
                'slug' => 'qwq-32b-preview',
                'provider' => 'Alibaba Qwen',
                'providerSlug' => 'qwen',
                'category' => 'reasoning',
                'categoryName' => 'Reasoning & Agentic',
                'throughput' => '320 tok/s',
                'ttft' => '240ms',
                'providersCount' => 28,
                'contextWindow' => '32k tokens',
                'inputPrice' => '$0.12 / 1M',
                'outputPrice' => '$0.36 / 1M',
                'tagline' => '32B open-weights reasoning sensation achieving benchmark parity with proprietary o1-mini at consumer GPU scale.',
                'summary' => 'QwQ 32B Preview is Alibaba experimental open-weights reasoning model that delivers extraordinary analytical power in a compact 32-billion parameter footprint. Capable of thinking aloud with detailed chain-of-thought derivations, QwQ rivals closed models in mathematics and coding while enabling full offline on-device deployment.',
                'architecture' => '32.5B parameter dense transformer fine-tuned using massive reinforcement learning over mathematical problem sets and formal code verification.',
                'keyCapabilities' => array(
                    'Open-weights reasoning model that can be self-hosted on a single NVIDIA RTX 4090 GPU with quantization.',
                    'Deep mathematical and algorithmic problem-solving with transparent internal thinking steps.',
                    'Exemplary multilingual mathematical derivation across English, Chinese, and European languages.',
                    'Remarkable cost efficiency with inference costing under $0.50 per million reasoning tokens.'
                ),
                'benchmarks' => array(
                    'AIME' => '75.2% pass rate',
                    'MATH' => '90.6% benchmark accuracy',
                    'LiveCodeBench' => '54.5% coding benchmark score',
                    'Throughput' => '320 tok/s'
                ),
                'googleSynergy' => 'Easily containerized on Google Cloud Run or GKE for private on-demand mathematical calculation microservices.',
                'samplePrompt' => 'Find all continuous functions f: R -> R satisfying f(x + y) + f(x - y) = 2f(x)cos(y) for all real x and y.',
                'sampleOutput' => '[Step-by-step Cauchy functional equation derivation proving the general solution is f(x) = A cos(x) + B sin(x) with complete boundary condition analysis]'
            ),
            array(
                'id' => 'google/gemini-2.5-flash-thinking',
                'name' => 'Gemini 2.5 Flash Thinking',
                'slug' => 'gemini-2-5-flash-thinking',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'reasoning',
                'categoryName' => 'Reasoning & Agentic',
                'throughput' => '280 tok/s',
                'ttft' => '160ms',
                'providersCount' => 34,
                'contextWindow' => '1M tokens',
                'inputPrice' => '$0.15 / 1M',
                'outputPrice' => '$0.60 / 1M',
                'tagline' => 'Google DeepMind 1M context reasoning engine combining chain-of-thought deliberation with massive document comprehension.',
                'summary' => 'Gemini 2.5 Flash Thinking bridges the gap between deep chain-of-thought reasoning and massive context capacity. While other reasoning models are constrained by small context windows, Gemini 2.5 Flash Thinking can deliberate over a million tokens of source material, analyzing complex medical histories, legal filings, and legacy software systems with deep self-reflective verification.',
                'architecture' => 'Multimodal transformer incorporating dynamic test-time reasoning tokens into the Gemini Flash architecture with 1M token attention span.',
                'keyCapabilities' => array(
                    'Combines explicit chain-of-thought reasoning with an industry-leading 1,000,000 token context window.',
                    'Deep self-verification: catches subtle logical flaws in user instructions and corrects assumptions prior to output.',
                    'Visual spatial reasoning: interprets complex engineering schematics, architectural floor plans, and financial charts.',
                    'High output speed: streams deliberate thoughts at 280 tokens per second.'
                ),
                'benchmarks' => array(
                    'MATH-500' => '93.8% benchmark score',
                    'SWE-bench' => '51.4% resolved issues',
                    'MMLU-Pro' => '87.6% accuracy',
                    'Context Span' => '1,000,000 tokens'
                ),
                'googleSynergy' => 'Native Vertex AI engine with direct grounding against Google Search and private Google Cloud BigQuery datasets.',
                'samplePrompt' => 'Ingest these 20 clinical trial reports on oncology immunotherapies, analyze statistical discrepancies across hazard ratios, and evaluate methodological bias.',
                'sampleOutput' => '[Rigorous epidemiological meta-analysis detailing confidence interval shifts, potential publication bias, and therapeutic hazard ratio comparisons]'
            ),

            // =================================================================
            // 4. SPEECH & AUDIO INTELLIGENCE
            // =================================================================
            array(
                'id' => 'google/gemini-3.1-flash-tts',
                'name' => 'Gemini 3.1 Flash TTS Preview',
                'slug' => 'gemini-3-1-flash-tts',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'speech',
                'categoryName' => 'Speech & Audio',
                'throughput' => '420 tok/s',
                'ttft' => '95ms',
                'providersCount' => 12,
                'contextWindow' => '1M tokens',
                'inputPrice' => '$0.075 / 1M',
                'outputPrice' => '$0.30 / 1M',
                'tagline' => 'Sub-100ms real-time audio synthesis with multi-voice timbre and emotion modulation.',
                'summary' => 'Gemini 3.1 Flash TTS represents Google DeepMind latest breakthrough in streaming speech synthesis. Designed natively for bidirectional real-time conversational agents, it delivers human-parity naturalness, nuanced inflection control, and rapid dynamic prosody switching with less than 100 milliseconds latency.',
                'architecture' => 'Native multimodal neural audio decoder integrated directly into the Gemini Flash transformer backbone, bypassing separate cascaded text-to-speech pipelines for direct waveform tokenization.',
                'keyCapabilities' => array(
                    'Real-time streaming audio with sub-100ms Time To First Audio (TTFA).',
                    'Dynamic voice timbre adjustments based on conversational context and sentiment.',
                    'Seamless multilingual code-switching across 40+ global languages.',
                    'Direct audio-to-audio understanding without transcription bottleneck.'
                ),
                'benchmarks' => array(
                    'PESQ Score' => '4.68 / 5.0 (Near Broadcast Quality)',
                    'Speaker Similarity' => '94.2% across voice prompts',
                    'Latency p50' => '95ms Time-To-First-Audio',
                    'Word Error Rate' => '1.8% in noisy environments'
                ),
                'googleSynergy' => 'Native deployment on Google Cloud Vertex AI with direct integration into Gemini Live API and Cloud Speech-to-Text streaming pipelines.',
                'samplePrompt' => 'Synthesize a friendly customer onboarding greeting in a warm, consultative tone with subtle micro-pauses.',
                'sampleOutput' => '[Audio Stream: 24kHz stereo 16-bit PCM buffer output with warm cadence and zero robotic artifacts]'
            ),
            array(
                'id' => 'hexgrad/kokoro-82m',
                'name' => 'Kokoro 82M',
                'slug' => 'kokoro-82m',
                'provider' => 'Hexgrad',
                'providerSlug' => 'hexgrad',
                'category' => 'speech',
                'categoryName' => 'Speech & Audio',
                'throughput' => '650 tok/s',
                'ttft' => '110ms',
                'providersCount' => 18,
                'contextWindow' => '32k tokens',
                'inputPrice' => '$0.02 / 1M',
                'outputPrice' => '$0.08 / 1M',
                'tagline' => 'Ultra-lightweight 82M parameter open-weight TTS delivering studio-grade speech.',
                'summary' => 'Kokoro 82M has disrupted the speech AI landscape by proving that hyper-compact models can rival multi-billion parameter proprietary audio engines. At only 82 million parameters, Kokoro can run locally on mobile devices and edge GPUs while generating expressive, natural-sounding audio with negligible latency.',
                'architecture' => 'StyleTTS2-derived compact transformer architecture with a modernized adversarial acoustic predictor and neural vocoder.',
                'keyCapabilities' => array(
                    'Featherweight 82M model weights running effortlessly on consumer GPUs and Apple Silicon.',
                    'Studio-grade phonetic accuracy with phoneme-level prosody guidance.',
                    'Zero hallucinations or phonetic stuttering on technical jargon and acronyms.',
                    'Open weights architecture fully customizable for custom voice clones.'
                ),
                'benchmarks' => array(
                    'Model Footprint' => '320 MB VRAM footprint',
                    'Real-Time Factor (RTF)' => '0.04x on RTX 4090',
                    'Mean Opinion Score (MOS)' => '4.42 / 5.0',
                    'Throughput' => '650 tok/s median'
                ),
                'googleSynergy' => 'Easily containerized via Docker and deployed on Google Cloud Run with GPU support for serverless high-throughput voice generation.',
                'samplePrompt' => 'Read this scientific abstract on quantum entanglement with clear pronunciation and formal academic pacing.',
                'sampleOutput' => '[Audio Output: Crystal-clear studio-grade narration with flawless phoneme pacing]'
            ),
            array(
                'id' => 'x-ai/grok-voice-tts',
                'name' => 'Grok Voice TTS 1.0',
                'slug' => 'grok-voice-tts',
                'provider' => 'xAI',
                'providerSlug' => 'x-ai',
                'category' => 'speech',
                'categoryName' => 'Speech & Audio',
                'throughput' => '380 tok/s',
                'ttft' => '140ms',
                'providersCount' => 10,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.15 / 1M',
                'outputPrice' => '$0.60 / 1M',
                'tagline' => 'Conversational speech model with expressive inflection and witty personality.',
                'summary' => 'Grok Voice TTS 1.0 brings xAI irreverent, sharp conversational intelligence into the vocal domain. Trained specifically for interactive dialog, Grok Voice understands comedic timing, subtle sarcasm, and empathetic pacing far better than standard corporate voice models.',
                'architecture' => 'Transformer-based neural acoustic encoder paired with an autoregressive flow-matching vocoder optimized on extensive podcast and conversational audio datasets.',
                'keyCapabilities' => array(
                    'High conversational realism with dynamic breathing and micro-inflection modeling.',
                    'Context-aware comedic timing and emphasis.',
                    'Continuous speech streaming with low jitter over WebSocket connections.',
                    'Robust handling of slang, idioms, and colloquial speech patterns.'
                ),
                'benchmarks' => array(
                    'Emotional Expressiveness' => '91.8% human rating',
                    'Audio Latency' => '140ms median TTFT',
                    'MOS Score' => '4.55 / 5.0',
                    'Dynamic Range' => '24-bit 48kHz output'
                ),
                'googleSynergy' => 'Compatible with Google Cloud Speech ecosystems, WebRTC gateways, and Android audio streaming APIs.',
                'samplePrompt' => 'Explain quantum mechanics like a witty physics professor who has had two cups of espresso.',
                'sampleOutput' => '[Voice Stream: Energetic, humorous delivery with authentic vocal rises and comedic pauses]'
            ),
            array(
                'id' => 'qwen/qwen-audio-3.0-tts',
                'name' => 'Qwen-Audio-3.0-TTS Flash',
                'slug' => 'qwen-audio-3-0-tts',
                'provider' => 'Alibaba Qwen',
                'providerSlug' => 'qwen',
                'category' => 'speech',
                'categoryName' => 'Speech & Audio',
                'throughput' => '510 tok/s',
                'ttft' => '125ms',
                'providersCount' => 22,
                'contextWindow' => '64k tokens',
                'inputPrice' => '$0.05 / 1M',
                'outputPrice' => '$0.20 / 1M',
                'tagline' => 'Global multilingual speech model supporting 30+ Asian and European dialects.',
                'summary' => 'Qwen-Audio-3.0-TTS Flash is Alibaba high-speed speech synthesis engine engineered for global enterprise scalability. It excels particularly in complex Asian tonal languages (Mandarin, Japanese, Cantonese, Korean) alongside European tongues, maintaining accent authenticity across dialectal boundaries.',
                'architecture' => 'Bilingual audio transformer backbone incorporating unified text-and-speech representation learning with low-bit quantization support.',
                'keyCapabilities' => array(
                    'Native mastery over Mandarin tonal pitch contours and Japanese pitch accents.',
                    'Cross-lingual voice transfer maintaining consistent speaker identity across languages.',
                    'High-throughput inference capable of serving thousands of concurrent IVR streams.',
                    'Built-in phoneme alignment for synchronized subtitle and transcript output.'
                ),
                'benchmarks' => array(
                    'Multilingual MOS' => '4.61 / 5.0 across 12 primary languages',
                    'Throughput' => '510 tok/s sustained',
                    'Tonal Error Rate' => '< 0.9% on Mandarin benchmark datasets',
                    'Cross-Lingual Identity' => '93.5% speaker cosine similarity'
                ),
                'googleSynergy' => 'Integrates seamlessly with Google Cloud Translation API and BigQuery voice analytics pipelines.',
                'samplePrompt' => 'Translate and read this business report smoothly in both English and Mandarin with executive tone.',
                'sampleOutput' => '[Multilingual audio: Flawless accent transition between English terminology and Mandarin prose]'
            ),
            array(
                'id' => 'deepgram/deepgram-aura-2',
                'name' => 'Deepgram Aura-2',
                'slug' => 'deepgram-aura-2',
                'provider' => 'Deepgram',
                'providerSlug' => 'deepgram',
                'category' => 'speech',
                'categoryName' => 'Speech & Audio',
                'throughput' => '480 tok/s',
                'ttft' => '85ms',
                'providersCount' => 15,
                'contextWindow' => '32k tokens',
                'inputPrice' => '$0.08 / 1M',
                'outputPrice' => '$0.32 / 1M',
                'tagline' => 'Ultra-low latency streaming voice engine designed for live telephonic AI agents.',
                'summary' => 'Deepgram Aura-2 is built specifically for latency-critical phone agents and contact centers. While conventional TTS models buffer whole sentences before speaking, Aura-2 starts emitting audio in just 85ms, eliminating awkward conversational pauses on telephony and WebRTC links.',
                'architecture' => 'Streaming causal convolutional-attention network optimized on custom TensorRT inference kernels for sub-100ms first-byte latency.',
                'keyCapabilities' => array(
                    'Instant 85ms TTFA engineered specifically to prevent conversational barge-in lag.',
                    'Telephony-optimized 8kHz/16kHz audio codecs alongside studio 48kHz.',
                    'Deep integration with SIP, Twilio, and WebRTC protocols.',
                    'Resilient prosody that avoids pitch drifting during multi-minute calls.'
                ),
                'benchmarks' => array(
                    'Time to First Audio (TTFA)' => '85ms p50 (Industry leading)',
                    'Call Completion Rate' => '98.4% in contact center pilots',
                    'Latency Standard Deviation' => '±12ms under heavy server load',
                    'Acoustic MOS' => '4.48 / 5.0'
                ),
                'googleSynergy' => 'Complementary with Google Cloud Contact Center AI (CCAI) and Dialogflow CX telephony voice channels.',
                'samplePrompt' => 'Confirm customer flight reschedule options concisely with prompt, reassuring customer support voice.',
                'sampleOutput' => '[Streaming Audio: 85ms first byte, crisp customer service persona]'
            ),

            // =================================================================
            // 5. VIDEO GENERATION SPECIALISTS
            // =================================================================
            array(
                'id' => 'bytedance/seedance-2.5',
                'name' => 'Seedance 2.5',
                'slug' => 'seedance-2-5',
                'provider' => 'ByteDance',
                'providerSlug' => 'bytedance',
                'category' => 'video',
                'categoryName' => 'Video Generation',
                'throughput' => '48 fps',
                'ttft' => '1.2s',
                'providersCount' => 14,
                'contextWindow' => '1080p 60fps',
                'inputPrice' => '$0.04 / sec',
                'outputPrice' => '$0.04 / sec',
                'tagline' => 'Frontier video diffusion model generating 1080p cinematic videos with realistic fluid dynamics.',
                'summary' => 'Seedance 2.5 by ByteDance represents the frontier of generative video diffusion. Designed for digital content creators, game developers, and marketing agencies, it generates hyper-realistic 1080p 60fps video clips from text or image prompts, with complex physics simulation, realistic cloth deformation, and coherent lighting transitions.',
                'architecture' => 'Spatio-temporal Video Diffusion Transformer (DiT) utilizing 3D causal convolutions and joint text-visual cross-attention.',
                'keyCapabilities' => array(
                    'Native 1080p 60fps video synthesis with exceptional temporal coherence.',
                    'Complex physics grounding including fluid turbulence, smoke propagation, and dynamic lighting reflections.',
                    'Camera trajectory controls: orbit, pan, crane, zoom, and handheld camera shake emulation.',
                    'Image-to-video animating static portraits and concept art with realistic facial kinematics.'
                ),
                'benchmarks' => array(
                    'VBench Video Quality' => '86.4% score',
                    'Temporal Consistency' => '92.1% frame-to-frame fidelity',
                    'Rendering Speed' => '48 fps hardware accelerated',
                    'Resolution' => '1920x1080 native 60fps'
                ),
                'googleSynergy' => 'Integrated with Google Cloud Storage bucket storage and Vertex AI video pipelines for batch marketing asset generation.',
                'samplePrompt' => 'Cinematic slow-motion shot of a glowing cybernetic tiger sprinting through a neon-lit Tokyo rainstorm at night, 8k resolution, photorealistic water splash physics.',
                'sampleOutput' => '[1080p MP4 Video: 8-second seamless clip with fluid muscle contractions, dynamic rain droplet reflections, and realistic camera tracking]'
            ),
            array(
                'id' => 'google/veo-3.1',
                'name' => 'Veo 3.1',
                'slug' => 'veo-3-1',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'video',
                'categoryName' => 'Video Generation',
                'throughput' => '60 fps',
                'ttft' => '1.5s',
                'providersCount' => 16,
                'contextWindow' => '4K UltraHD',
                'inputPrice' => '$0.06 / sec',
                'outputPrice' => '$0.06 / sec',
                'tagline' => 'Google DeepMind Hollywood-grade generative video model delivering 4K resolution with cinematic direction.',
                'summary' => 'Veo 3.1 is Google DeepMind most capable generative video model. Engineered for professional film studios, creative directors, and video editors, Veo understands cinematic terminology like "aerial shot", "anamorphic lens flare", and "depth of field", rendering breathtaking 4K clips with consistent characters and photorealistic lighting.',
                'architecture' => 'Latent Video Diffusion Transformer with temporal self-attention trained on Google custom TPU v5e supercomputing pods.',
                'keyCapabilities' => array(
                    'Native 4K Ultra-HD generative video generation with rich HDR color gamuts.',
                    'Cinematic prompt adherence understanding focal lengths (35mm, 50mm, anamorphic) and camera movements.',
                    'Zero-shot visual editing: modify backgrounds, weather, or time of day while preserving foreground actors.',
                    'Storyboarding consistency across multiple sequential camera angles.'
                ),
                'benchmarks' => array(
                    'Photorealism Human Evaluation' => '94.2% preference rating',
                    'Cinematic Instruction Following' => '91.8%',
                    'Resolution' => '3840x2160 UltraHD',
                    'Frame Consistency' => '96.5% over 10-second takes'
                ),
                'googleSynergy' => 'Native deployment via Google Cloud Vertex AI Studio and integration with YouTube Creator Tools and Google Workspace.',
                'samplePrompt' => 'Anamorphic 35mm lens drone shot sweeping over a sun-drenched Italian vineyard in Tuscany during golden hour, cinematic color grading, warm lens flare.',
                'sampleOutput' => '[4K UltraHD Video: 10-second smooth cinematic flyover with natural vine motion and photorealistic atmospheric haze]'
            ),
            array(
                'id' => 'heygen/heygen-video',
                'name' => 'HeyGen Video 2.0',
                'slug' => 'heygen-video',
                'provider' => 'HeyGen',
                'providerSlug' => 'heygen',
                'category' => 'video',
                'categoryName' => 'Video Generation',
                'throughput' => '30 fps',
                'ttft' => '2.0s',
                'providersCount' => 10,
                'contextWindow' => '1080p Avatar',
                'inputPrice' => '$0.05 / sec',
                'outputPrice' => '$0.05 / sec',
                'tagline' => 'Enterprise photorealistic avatar generation with pixel-perfect lip synchronization.',
                'summary' => 'HeyGen Video 2.0 leads the enterprise video generation sector for automated training, corporate communications, and multilingual video localization. Its breakthrough lies in pixel-perfect lip synchronization and micro-expression modeling that creates indistinguishable digital twins in 175+ languages.',
                'architecture' => 'Neural facial radiance field paired with a conditional generative diffusion model for phoneme-to-mouth geometry mapping.',
                'keyCapabilities' => array(
                    'Pixel-perfect lip synchronization aligning with speech in 175+ languages and regional accents.',
                    'Natural head micro-movements, eye contact, and blink rate modeling.',
                    'Automated voice translation matching the original speaker vocal timbre and pitch.',
                    'API-first batch rendering for personalized enterprise marketing outreach.'
                ),
                'benchmarks' => array(
                    'Lip Sync Accuracy' => '98.7% phoneme alignment',
                    'Realism Index' => '93.5% human observer rating',
                    'Rendering Latency' => '0.8x real-time generation speed',
                    'Language Support' => '175+ global languages'
                ),
                'googleSynergy' => 'Connects to Google Cloud Translation API and Google Drive for automated batch corporate video localization.',
                'samplePrompt' => 'Render an executive digital spokesperson delivering quarterly financial earnings in fluent German with confident corporate posture.',
                'sampleOutput' => '[1080p Video: Flawless German lip-sync with subtle head nods and photorealistic suit fabric lighting]'
            ),
            array(
                'id' => 'x-ai/grok-imagine-video',
                'name' => 'Grok Imagine Video 1.5',
                'slug' => 'grok-imagine-video',
                'provider' => 'xAI',
                'providerSlug' => 'x-ai',
                'category' => 'video',
                'categoryName' => 'Video Generation',
                'throughput' => '40 fps',
                'ttft' => '1.8s',
                'providersCount' => 12,
                'contextWindow' => '1080p 30fps',
                'inputPrice' => '$0.05 / sec',
                'outputPrice' => '$0.05 / sec',
                'tagline' => 'Fast-rendering generative video engine with creative visual flare and dynamic camera motion.',
                'summary' => 'Grok Imagine Video 1.5 is xAI high-tempo generative video platform designed for rapid concept generation and creative storytelling. Trained on massive datasets of digital cinema and visual effects, Grok Imagine excels at dramatic action sequences, sci-fi world-building, and expressive character animation.',
                'architecture' => 'Continuous-time flow matching video transformer with accelerated multi-GPU tensor parallel inference.',
                'keyCapabilities' => array(
                    'Rapid video generation speed producing 1080p preview clips in under 10 seconds.',
                    'Bold artistic direction across cyberpunk, anime, photorealism, and vintage film grain styles.',
                    'Strong spatial understanding maintaining consistent character identities across complex action scenes.',
                    'Seamless looping video generation for social media and ambient digital displays.'
                ),
                'benchmarks' => array(
                    'Visual Quality' => '84.8% VBench benchmark',
                    'Motion Fidelity' => '89.2% smooth frame progression',
                    'Generation Latency' => '9.5 seconds per 5-second clip',
                    'Style Diversity' => '96.0% aesthetic adherence'
                ),
                'googleSynergy' => 'Compatible with Google Cloud Storage and CDN pipelines for high-traffic social media streaming delivery.',
                'samplePrompt' => 'Dynamic tracking shot of an astronaut surfing across an interstellar comet tail with swirling iridescent cosmic dust.',
                'sampleOutput' => '[1080p Video: High-energy action sequence with vibrant neon dust particles and smooth cinematic camera tracking]'
            ),
            array(
                'id' => 'kwaivgi/kling-ai-1.5',
                'name' => 'Kling AI 1.5',
                'slug' => 'kling-ai-1-5',
                'provider' => 'Kuaishou',
                'providerSlug' => 'kwaivgi',
                'category' => 'video',
                'categoryName' => 'Video Generation',
                'throughput' => '30 fps',
                'ttft' => '2.5s',
                'providersCount' => 16,
                'contextWindow' => '1080p 2-minute',
                'inputPrice' => '$0.04 / sec',
                'outputPrice' => '$0.04 / sec',
                'tagline' => 'Long-form generative video powerhouse capable of sustaining consistent physical motion up to 2 minutes.',
                'summary' => 'Kling AI 1.5 has set industry benchmarks for long-form generative video. While most video models degrade into visual static after 5 seconds, Kling proprietary 3D Spatio-Temporal Attention mechanism can generate up to two full minutes of coherent video at 1080p resolution with realistic physical laws and complex character interactions.',
                'architecture' => '3D Spatio-Temporal Attention diffusion network incorporating neural physics simulation kernels.',
                'keyCapabilities' => array(
                    'Industry-leading continuous video duration up to 120 seconds with zero visual degradation.',
                    'Accurate physical simulations: eating noodles, pouring liquids, running through crowds, and driving cars.',
                    'Multi-prompt keyframe steering allowing creators to storyboard narrative arcs.',
                    'High-resolution 1080p output with realistic skin textures and natural motion blur.'
                ),
                'benchmarks' => array(
                    'Physical Plausibility' => '92.4% human evaluation score',
                    'Max Coherent Duration' => '120 seconds continuous video',
                    'VBench Total' => '85.6% benchmark score',
                    'Resolution' => '1080p at 30fps'
                ),
                'googleSynergy' => 'Easily integrated with Google Cloud transcoding workflows for automatic adaptation across mobile and web video formats.',
                'samplePrompt' => 'Continuous single-take shot of an elderly artisan in a sunlit workshop meticulously carving an ornate wooden clock, natural hand movements, dust motes floating in sunlight.',
                'sampleOutput' => '[1080p Video: Realistic wood shavings falling, authentic chisel pressure, and consistent natural lighting throughout 15 seconds]'
            ),

            // =================================================================
            // 6. IMAGE GENERATION & VISION ENGINES
            // =================================================================
            array(
                'id' => 'google/nano-banana-2',
                'name' => 'Nano Banana 2',
                'slug' => 'nano-banana-2',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '4 imgs/s',
                'ttft' => '780ms',
                'providersCount' => 19,
                'contextWindow' => '2048x2048',
                'inputPrice' => '$0.015 / img',
                'outputPrice' => '$0.015 / img',
                'tagline' => 'Next-generation flow transformer generating crisp photorealistic artwork and sharp legible typography in under 800ms.',
                'summary' => 'Nano Banana 2 is Google high-velocity flow transformer visual synthesis engine. Designed to solve the historical challenges of diffusion models, Nano Banana 2 delivers sub-second rendering, pixel-perfect text typography rendering inside images, and photorealistic skin, glass, and metal texture rendering.',
                'architecture' => 'Latent Rectified Flow Transformer with multimodal cross-attention trained on Google TPU v5e clusters.',
                'keyCapabilities' => array(
                    'Sub-800ms Time To First Image rendering enabling real-time interactive design canvases.',
                    'Pixel-perfect typographical rendering of complex text prompts, signage, book covers, and logos.',
                    'Photorealistic material rendering with accurate light refraction through glass and water.',
                    'Native high-resolution 2048x2048 output without separate upscaler artifacts.'
                ),
                'benchmarks' => array(
                    'Text Typography Accuracy' => '96.2% legible text rendering',
                    'Generation Latency' => '780ms per 1024x1024 image',
                    'Human Preference Score' => '91.4% vs. legacy diffusion models',
                    'Max Resolution' => '2048x2048 native'
                ),
                'googleSynergy' => 'Native Vertex AI image generation API with full support for Imagen fine-tuning and Google Cloud Storage bucket export.',
                'samplePrompt' => 'Vintage Parisian bakery storefront in 1920 with crisp gold leaf typography on the window reading "BOULANGERIE MODERNE", warm interior lighting, cobblestone street, 8k resolution.',
                'sampleOutput' => '[Photorealistic 2048x2048 PNG: Flawless French typography on glass with realistic reflections, volumetric bakery interior glow, and wet cobblestone textures]'
            ),
            array(
                'id' => 'openai/gpt-image-2.5-sunburst',
                'name' => 'GPT Image 2.5 Sunburst',
                'slug' => 'gpt-image-2-5-sunburst',
                'provider' => 'OpenAI',
                'providerSlug' => 'openai',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '3 imgs/s',
                'ttft' => '920ms',
                'providersCount' => 24,
                'contextWindow' => '1792x1024',
                'inputPrice' => '$0.020 / img',
                'outputPrice' => '$0.020 / img',
                'tagline' => 'OpenAI premier visual synthesis engine with unmatched prompt fidelity and nuanced spatial composition.',
                'summary' => 'GPT Image 2.5 Sunburst is OpenAI latest visual foundation model, engineered with extraordinary semantic comprehension. It faithfully renders complex multi-object prompts, intricate spatial arrangements, and subtle lighting directions that confound traditional diffusion engines.',
                'architecture' => 'Autoregressive multimodal transformer paired with a continuous-time diffusion decoder fine-tuned on dense semantic descriptions.',
                'keyCapabilities' => array(
                    'Unrivaled semantic prompt fidelity: accurately positions 10+ distinct objects in exact spatial relationships.',
                    'Exceptional human anatomical precision eliminating hand and finger distortions.',
                    'Seamless style versatility from technical architectural CAD drawings to Renaissance oil paintings.',
                    'Inpainting and outpainting API capabilities for precise canvas extension.'
                ),
                'benchmarks' => array(
                    'Prompt Adherence' => '94.8% benchmark score',
                    'Anatomy Fidelity' => '97.2% correct hand/finger rendering',
                    'Rendering Speed' => '920ms average generation time',
                    'Aspect Ratios' => '16:9, 1:1, 9:16, 21:9 anamorphic'
                ),
                'googleSynergy' => 'Easily integrated with Google Cloud App Engine and Firebase backends for dynamic user-generated content generation.',
                'samplePrompt' => 'Exploded view technical blueprint diagram of a mechanical wristwatch with floating gear trains, tourbillon escapement, callout labels, white lines on dark navy blue background.',
                'sampleOutput' => '[Ultra-detailed technical blueprint graphic with accurate gear tooth profiles, crisp callout annotations, and immaculate line art precision]'
            ),
            array(
                'id' => 'bytedance/seedream-5.0-pro',
                'name' => 'Seedream 5.0 Pro',
                'slug' => 'seedream-5-0-pro',
                'provider' => 'ByteDance',
                'providerSlug' => 'bytedance',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '5 imgs/s',
                'ttft' => '650ms',
                'providersCount' => 21,
                'contextWindow' => '4096x4096',
                'inputPrice' => '$0.018 / img',
                'outputPrice' => '$0.018 / img',
                'tagline' => 'High-resolution 4K generative visual engine built for e-commerce, advertising, and hyper-detailed product photography.',
                'summary' => 'Seedream 5.0 Pro by ByteDance is tailored for commercial advertising, fashion, and industrial product design. Featuring an enormous 4096x4096 native rendering pipeline, Seedream renders microscopic fabric weaves, cosmetics textures, and studio lighting with commercial catalog perfection.',
                'architecture' => 'High-capacity latent diffusion transformer with dual text encoders (CLIP + T5-XXL) and an ultra-deep variational autoencoder.',
                'keyCapabilities' => array(
                    'Massive native 4096x4096 pixel resolution with microscopic texture detail.',
                    'Studio commercial product photography with professional three-point lighting setups.',
                    'Virtual fashion modeling with realistic cloth drape, stitching, and material sheen.',
                    'High inference throughput of 5 images per second on enterprise GPU clusters.'
                ),
                'benchmarks' => array(
                    'Commercial Preference Rating' => '93.8%',
                    'Resolution' => '4096x4096 Ultra-HD native',
                    'Generation Latency' => '650ms per batch',
                    'Fabric Realism' => '95.6% realism score'
                ),
                'googleSynergy' => 'Integrates with Google Cloud Vision API for automated product tagging and BigQuery catalog indexing.',
                'samplePrompt' => 'Studio product shot of a luxury matte black mechanical watch resting on wet basalt stone, water droplets, dramatic rim lighting, Hasselblad medium format camera aesthetic.',
                'sampleOutput' => '[Hyper-detailed 4K product photograph with sharp metallic bezel ridges, realistic water bead refraction, and subtle leather strap stitching]'
            ),
            array(
                'id' => 'meta/muse-image',
                'name' => 'Muse Image',
                'slug' => 'muse-image',
                'provider' => 'Meta',
                'providerSlug' => 'meta',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '8 imgs/s',
                'ttft' => '450ms',
                'providersCount' => 17,
                'contextWindow' => '1024x1024',
                'inputPrice' => '$0.008 / img',
                'outputPrice' => '$0.008 / img',
                'tagline' => 'Ultra-fast masked generative transformer generating images 10x faster than traditional diffusion models.',
                'summary' => 'Muse Image is Meta masked generative transformer that departs from iterative diffusion. By predicting discrete visual tokens in parallel across a masked grid, Muse generates full-fidelity 1024x1024 images in just 450 milliseconds, making it ideal for real-time creative tools and high-volume mobile generation.',
                'architecture' => 'Masked generative sequence-to-sequence transformer operating over discrete VQ-GAN visual tokens.',
                'keyCapabilities' => array(
                    'Parallel token generation 10x faster than traditional diffusion sampling steps.',
                    'Native zero-shot inpainting, object removal, and style transfer without specialized training.',
                    'Extremely low inference cost under one penny per generated image.',
                    'Featherweight compute footprint suitable for edge and browser-based rendering.'
                ),
                'benchmarks' => array(
                    'Generation Speed' => '450ms (Industry leading throughput)',
                    'Throughput' => '8 images per second per GPU',
                    'FID Score' => '6.8 on ImageNet 512x512',
                    'Cost Efficiency' => '$0.008 per render'
                ),
                'googleSynergy' => 'Optimal for high-velocity image generation microservices deployed on Google Cloud Kubernetes Engine with autoscaling.',
                'samplePrompt' => 'A whimsical watercolor illustration of a friendly red fox reading a book under a giant oak tree in autumn, gentle pastel tones.',
                'sampleOutput' => '[Delightful pastel watercolor illustration with authentic paper grain texture, soft paint bleeds, and warm autumn foliage]'
            ),
            array(
                'id' => 'x-ai/grok-vision-2',
                'name' => 'Grok Vision 2',
                'slug' => 'grok-vision-2',
                'provider' => 'xAI',
                'providerSlug' => 'x-ai',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '4 imgs/s',
                'ttft' => '820ms',
                'providersCount' => 14,
                'contextWindow' => '2048x2048',
                'inputPrice' => '$0.016 / img',
                'outputPrice' => '$0.016 / img',
                'tagline' => 'Multimodal vision and generation model with razor-sharp scientific and architectural understanding.',
                'summary' => 'Grok Vision 2 combines generative artistic prowess with deep analytical vision. It can simultaneously analyze complex scientific microscopy and satellite imagery, while generating photorealistic scenes with dramatic lighting, bold contrast, and sharp technological detail.',
                'architecture' => 'Dual-stream visual transformer backbone with shared cross-modal latent diffusion for simultaneous generation and visual question answering.',
                'keyCapabilities' => array(
                    'Dual-capability engine: visual question answering and photorealistic generation in one unified model.',
                    'Deep understanding of technical blueprints, electrical schematics, and astronomical photography.',
                    'High dynamic range lighting with rich contrast and realistic atmospheric haze.',
                    'Surgical canvas editing through natural language instructions.'
                ),
                'benchmarks' => array(
                    'DocVQA Score' => '91.2% document comprehension',
                    'Visual Quality' => '88.5% human preference rating',
                    'Resolution' => '2048x2048 Ultra-HD',
                    'Generation Latency' => '820ms median'
                ),
                'googleSynergy' => 'Complements Google Cloud Document AI pipelines for processing complex visual forms, blueprints, and multi-column invoices.',
                'samplePrompt' => 'Futuristic sustainable hydroponic vertical farm inside a glass geodesic dome overlooking Mars red desert landscape, golden sunlight filtering through glass.',
                'sampleOutput' => '[Photorealistic architectural visual: Lush green hydroponic plant towers contrasting vividly against Mars red surface, with pristine glass refraction]'
            ),

            // =================================================================
            // 7. FASTEST & HIGH-THROUGHPUT MODELS
            // =================================================================
            array(
                'id' => 'openai/gpt-oss-120b',
                'name' => 'gpt-oss-120b',
                'slug' => 'gpt-oss-120b',
                'provider' => 'OpenAI',
                'providerSlug' => 'openai',
                'category' => 'fastest',
                'categoryName' => 'Fastest Models',
                'throughput' => '850 tok/s',
                'ttft' => '158ms',
                'providersCount' => 26,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.06 / 1M',
                'outputPrice' => '$0.24 / 1M',
                'tagline' => '#1 Fastest Model globally delivering blistering 850 tok/s throughput across 26 cloud endpoints.',
                'summary' => 'gpt-oss-120b holds the undisputed #1 ranking on OpenRouter for pure streaming output velocity. Delivering a staggering median output speed of 850 tokens per second with a 158ms Time-To-First-Token, it generates entire pages of code or technical documentation in less than a second.',
                'architecture' => 'Speculatively decoded dense transformer architecture running on dedicated high-memory-bandwidth hardware clusters.',
                'keyCapabilities' => array(
                    'Blistering 850 tokens/second output speed for instant real-time user experiences.',
                    'Low 158ms median time-to-first-token p50 eliminating interactive latency.',
                    'Generous 128,000 token context window supporting long document processing.',
                    'Extremely economical pricing at only $0.06 per million input tokens.'
                ),
                'benchmarks' => array(
                    'Median Throughput' => '850 tok/s (Rank #1 Worldwide)',
                    'TTFT p50' => '158ms latency',
                    'MMLU Benchmark' => '82.4%',
                    'HumanEval' => '84.8% code pass rate'
                ),
                'googleSynergy' => 'Exceptional for high-volume BigQuery ETL data enrichment jobs where processing billions of rows requires extreme token throughput.',
                'samplePrompt' => 'Summarize this 10,000-word corporate earnings transcript into 5 executive action bullet points.',
                'sampleOutput' => '[Instantly rendered executive summary with 5 high-impact bullet points delivered in 400 milliseconds]'
            ),
            array(
                'id' => 'qwen/qwen-3.8-27b',
                'name' => 'Qwen 3.8 27B',
                'slug' => 'qwen-3-8-27b',
                'provider' => 'Alibaba Qwen',
                'providerSlug' => 'qwen',
                'category' => 'fastest',
                'categoryName' => 'Fastest Models',
                'throughput' => '720 tok/s',
                'ttft' => '238ms',
                'providersCount' => 24,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.05 / 1M',
                'outputPrice' => '$0.18 / 1M',
                'tagline' => '#2 Fastest Model on OpenRouter streaming 720 tok/s with strong multilingual intelligence.',
                'summary' => 'Qwen 3.8 27B holds the #2 spot globally for inference velocity. Balancing high-speed speculative decoding with rich multilingual pre-training, it outputs 720 tokens per second while maintaining high benchmark accuracy across mathematical reasoning and software development.',
                'architecture' => '27-billion parameter transformer with Grouped-Query Attention, FP8 quantization optimization, and specialized speculative draft heads.',
                'keyCapabilities' => array(
                    '720 tokens per second output speed for rapid real-time AI copilots.',
                    'Deep multilingual comprehension across English, Chinese, Japanese, and European languages.',
                    '238ms TTFT latency ensuring instantaneous user feedback.',
                    'Optimal memory footprint fitting comfortably on single cloud GPU instances.'
                ),
                'benchmarks' => array(
                    'Throughput' => '720 tok/s (Rank #2 Worldwide)',
                    'TTFT p50' => '238ms',
                    'MMLU' => '81.6% accuracy',
                    'Math Reasoning' => '78.2% on GSM8k'
                ),
                'googleSynergy' => 'Can be deployed via Google Cloud Run with GPU for cost-effective serverless API endpoints.',
                'samplePrompt' => 'Draft a real-time conversational customer support response resolving an e-commerce shipping delay.',
                'sampleOutput' => '[Instant, empathetic customer support response with order tracking steps generated in under a quarter of a second]'
            ),
            array(
                'id' => 'deepseek/deepseek-v4.1-flash',
                'name' => 'DeepSeek V4.1 Flash 1017',
                'slug' => 'deepseek-v4-1-flash-1017',
                'provider' => 'DeepSeek',
                'providerSlug' => 'deepseek',
                'category' => 'fastest',
                'categoryName' => 'Fastest Models',
                'throughput' => '524 tok/s',
                'ttft' => '271ms',
                'providersCount' => 49,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.04 / 1M',
                'outputPrice' => '$0.12 / 1M',
                'tagline' => '#3 Ranked in Fastest Models with 524 tok/s throughput across 49 decentralized hosting endpoints.',
                'summary' => 'DeepSeek V4.1 Flash 1017 is DeepSeek flagship high-throughput speed model, ranked #3 worldwide. Operating across 49 distributed cloud endpoints, it delivers 524 tokens per second with multi-head latent attention (MLA), providing exceptional developer copilot performance at nominal costs.',
                'architecture' => 'Sparse Mixture-of-Experts (MoE) with Multi-head Latent Attention (MLA) and FP8 matrix acceleration.',
                'keyCapabilities' => array(
                    '524 tokens per second throughput supported across 49 independent cloud hosting endpoints.',
                    'Multi-head Latent Attention drastically reducing KV cache size during high concurrency.',
                    'Strong coding and reasoning capability derived from DeepSeek V3 pre-training.',
                    'Ultra-affordable pricing at $0.04 per million input tokens.'
                ),
                'benchmarks' => array(
                    'Throughput' => '524 tok/s (Rank #3 Worldwide)',
                    'TTFT p50' => '271ms',
                    'Active Providers' => '49 Endpoints',
                    'HumanEval' => '83.2% code accuracy'
                ),
                'googleSynergy' => 'Ideal for parallel document analysis and batch entity extraction pipelines on Google Cloud Storage.',
                'samplePrompt' => 'Parse this raw server log file and extract all IP addresses, HTTP status codes, and error traces into a clean JSON table.',
                'sampleOutput' => '[Instantly generated JSON structure with parsed log metrics delivered in 300 milliseconds]'
            ),
            array(
                'id' => 'beam/beam-1.0-501b',
                'name' => 'Beam 1.0 501B A23B',
                'slug' => 'beam-1-0-501b-a23b',
                'provider' => 'Beam',
                'providerSlug' => 'beam',
                'category' => 'fastest',
                'categoryName' => 'Fastest Models',
                'throughput' => '436 tok/s',
                'ttft' => '253ms',
                'providersCount' => 5,
                'contextWindow' => '64k tokens',
                'inputPrice' => '$0.08 / 1M',
                'outputPrice' => '$0.28 / 1M',
                'tagline' => '#4 Fastest Model globally combining 501B total parameters with 23B active routing for 436 tok/s throughput.',
                'summary' => 'Beam 1.0 501B A23B is an architectural tour-de-force in sparse routing. With 501 billion total parameters but only 23 billion active per token, Beam achieves massive encyclopedic knowledge and complex reasoning while streaming output at an astonishing 436 tokens per second.',
                'architecture' => '501-billion parameter fine-grained Mixture-of-Experts with 23B activated parameters and dynamic top-k routing.',
                'keyCapabilities' => array(
                    '436 tokens per second throughput powered by 23B active expert execution.',
                    '501B parameter knowledge base retaining deep facts across medicine, engineering, and history.',
                    'Low 253ms TTFT latency for snappy search and question-answering engines.',
                    'Advanced routing that prevents expert bottlenecking under high server concurrency.'
                ),
                'benchmarks' => array(
                    'Throughput' => '436 tok/s (Rank #4 Worldwide)',
                    'TTFT p50' => '253ms',
                    'Total Parameters' => '501 Billion (23B active)',
                    'MMLU' => '85.4% benchmark score'
                ),
                'googleSynergy' => 'Compatible with hybrid Google Cloud BigQuery search grounding workflows for real-time customer intelligence.',
                'samplePrompt' => 'Explain the physics of gravitational wave detection using laser interferometry at LIGO.',
                'sampleOutput' => '[Extensive physical explanation with Michelson interferometer ray diagrams and strain tensor equations produced in 600ms]'
            ),
            array(
                'id' => 'meta-llama/llama-3.1-8b-instruct',
                'name' => 'Llama 3.1 8B Instruct',
                'slug' => 'llama-3-1-8b-instruct',
                'provider' => 'Meta',
                'providerSlug' => 'meta',
                'category' => 'fastest',
                'categoryName' => 'Fastest Models',
                'throughput' => '434 tok/s',
                'ttft' => '165ms',
                'providersCount' => 45,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.03 / 1M',
                'outputPrice' => '$0.06 / 1M',
                'tagline' => '#5 Ranked Speed Leader with 434 tok/s throughput and sub-170ms latency across 45 global endpoints.',
                'summary' => 'Llama 3.1 8B Instruct is Meta lightweight champion, ranked #5 in the world for speed on OpenRouter. Streaming output at 434 tokens per second with an ultra-responsive 165ms Time-To-First-Token, it is the workhorse of choice for customer support chatbots, data extraction, and interactive copilot sidebars.',
                'architecture' => '8-billion parameter dense decoder-only transformer with Grouped-Query Attention (GQA) and 128k rotary positional embeddings.',
                'keyCapabilities' => array(
                    '434 tokens per second throughput with 165ms Time-To-First-Token p50.',
                    'Massive 128,000 token context window in an 8B model footprint.',
                    'Ubiquitous global hosting supported by 45 distinct cloud providers on OpenRouter.',
                    'Extremely low inference cost at only $0.03 per million input tokens.'
                ),
                'benchmarks' => array(
                    'Throughput' => '434 tok/s (Rank #5 Worldwide)',
                    'TTFT p50' => '165ms (Sub-200ms latency)',
                    'MMLU' => '68.4% benchmark accuracy',
                    'Active Providers' => '45 Endpoints'
                ),
                'googleSynergy' => 'Runs natively on Google Cloud Run, Android devices with Mediapipe, and Google Kubernetes Engine clusters.',
                'samplePrompt' => 'Classify the sentiment of these 50 customer reviews into Positive, Neutral, or Negative with confidence scores.',
                'sampleOutput' => '[Instantly generated JSON classification for 50 records in under 350 milliseconds]'
            ),

            // =================================================================
            // 8. VALUE LEADERS (Maximum Intelligence Per Dollar)
            // =================================================================
            array(
                'id' => 'zhipu/glm-5.3-flash',
                'name' => 'GLM 5.3 Flash',
                'slug' => 'glm-5-3-flash',
                'provider' => 'Zhipu AI',
                'providerSlug' => 'zhipu-ai',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '480 tok/s',
                'ttft' => '190ms',
                'providersCount' => 14,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.02 / 1M',
                'outputPrice' => '$0.08 / 1M',
                'tagline' => '#1 Ranked in Value Leaders on OpenRouter with 79% coding percentile and 92% agentic capability.',
                'summary' => 'GLM 5.3 Flash holds the coveted #1 position on the OpenRouter Value Leaderboard. Offering an extraordinary 79% coding percentile and 92% agentic task completion rate for mere pennies, it proves that cutting-edge tool orchestration and developer intelligence can be delivered at commodity scale.',
                'architecture' => 'General Language Model (GLM) autoregressive blank-filling transformer optimized for agentic tool use and high concurrency.',
                'keyCapabilities' => array(
                    'Rank #1 Global Value Leader on OpenRouter for highest capability per dollar.',
                    '92% agentic workflow completion score executing multi-step browser and API tasks.',
                    '79% coding percentile rivaling models costing 20 times more.',
                    'Fast 480 tokens per second throughput with 128k context span.'
                ),
                'benchmarks' => array(
                    'Agentic Score' => '92% (Rank #1 Value Leader)',
                    'Coding Percentile' => '79%',
                    'Intelligence Percentile' => '41%',
                    'Value Rank' => '#1 on OpenRouter'
                ),
                'googleSynergy' => 'Perfect engine for driving background data verification workers and automated scrapers on Google Cloud Compute Engine.',
                'samplePrompt' => 'Formulate an autonomous API workflow that fetches currency exchange rates, validates against central bank data, and formats a daily treasury report.',
                'sampleOutput' => '[Complete autonomous Python script with resilient error retries, API validation schemas, and automated report output]'
            ),
            array(
                'id' => 'anthropic/claude-haiku-5.5',
                'name' => 'Claude Haiku 5.5 (Batch)',
                'slug' => 'claude-haiku-5-5-batch',
                'provider' => 'Anthropic',
                'providerSlug' => 'anthropic',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '360 tok/s',
                'ttft' => 'Batch SLA',
                'providersCount' => 20,
                'contextWindow' => '200k tokens',
                'inputPrice' => '$0.125 / 1M',
                'outputPrice' => '$0.50 / 1M',
                'tagline' => '#2 Ranked Value Leader on OpenRouter with 66% intelligence percentile and 200k context.',
                'summary' => 'Claude Haiku 5.5 in Batch mode holds the #2 spot on the OpenRouter Value Leaderboard. Offering Anthropic signature Constitutional AI safety, 200k context window, and 66% intelligence percentile at a fraction of standard pricing, it is the premier choice for massive batch document analysis and dataset synthesis.',
                'architecture' => 'Compact dense transformer optimized for asynchronous batch pipeline execution with Anthropic Constitutional alignment.',
                'keyCapabilities' => array(
                    'Rank #2 Value Leader on OpenRouter with 66% general intelligence percentile.',
                    'Massive 200,000 token context window at an affordable batch rate.',
                    'High precision instruction following with zero refusal on non-harmful enterprise data.',
                    'Deep synergy with asynchronous document processing pipelines.'
                ),
                'benchmarks' => array(
                    'Intelligence Percentile' => '66% (Highest among top 5 value models)',
                    'Context Window' => '200k tokens',
                    'Value Rank' => '#2 Global Value Leader',
                    'Batch Throughput' => 'High-volume SLA'
                ),
                'googleSynergy' => 'Integrates with Google Cloud Storage batch ingestion pipelines for processing millions of scanned PDFs overnight.',
                'samplePrompt' => 'Process these 50 legal contracts, extract all indemnification liability caps, governing law jurisdictions, and termination notice periods.',
                'sampleOutput' => '[Structured CSV table accurately summarizing liability caps, governing law, and termination notice timelines for all 50 contracts]'
            ),
            array(
                'id' => 'deepseek/deepseek-v4-flash-0731',
                'name' => 'DeepSeek V4 Flash 0731',
                'slug' => 'deepseek-v4-flash-0731',
                'provider' => 'DeepSeek',
                'providerSlug' => 'deepseek',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '560 tok/s',
                'ttft' => '210ms',
                'providersCount' => 38,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.03 / 1M',
                'outputPrice' => '$0.10 / 1M',
                'tagline' => '#3 Ranked in Value Leaders with 75% coding percentile and 78% agentic score.',
                'summary' => 'DeepSeek V4 Flash 0731 holds the #3 position on the OpenRouter Value Leaderboard. Engineered for extreme cost efficiency without compromising technical depth, it achieves a 75% coding percentile and 78% agentic score, making it a favorite for autonomous coding agents and automated refactoring bots.',
                'architecture' => 'Sparse Mixture-of-Experts with Multi-head Latent Attention (MLA) and low-precision FP8 inference kernels.',
                'keyCapabilities' => array(
                    '75% coding percentile matching proprietary models 15x its price.',
                    '78% agentic workflow score for automated GitHub issue triage and testing.',
                    'Lightning-fast 560 tokens per second throughput.',
                    'Exceptional economics: process a million input tokens for just three cents.'
                ),
                'benchmarks' => array(
                    'Coding Percentile' => '75%',
                    'Agentic Score' => '78%',
                    'Value Rank' => '#3 Global Value Leader',
                    'Throughput' => '560 tok/s'
                ),
                'googleSynergy' => 'Superb for high-scale document OCR text correction and BigQuery dataset augmentation.',
                'samplePrompt' => 'Write an automated bash script that monitors disk usage, rotates logs older than 7 days, and alerts via Slack webhook on 90% threshold.',
                'sampleOutput' => '[Clean, robust bash script with error trapping, crontab instructions, logrotate configuration, and Slack payload handling]'
            ),
            array(
                'id' => 'deepseek/deepseek-v4-flash-0423',
                'name' => 'DeepSeek V4 Flash 0423',
                'slug' => 'deepseek-v4-flash-0423',
                'provider' => 'DeepSeek',
                'providerSlug' => 'deepseek',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '540 tok/s',
                'ttft' => '215ms',
                'providersCount' => 32,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.03 / 1M',
                'outputPrice' => '$0.09 / 1M',
                'tagline' => '#4 Ranked Value Leader on OpenRouter with 59% coding percentile and 54% agentic efficiency.',
                'summary' => 'DeepSeek V4 Flash 0423 ranks #4 on the OpenRouter Value Leaderboard. Providing consistent 540 tok/s throughput with solid 59% coding and 54% agentic ratings, it delivers dependable high-speed intelligence for bulk classification and large-scale data cleansing.',
                'architecture' => 'Fine-grained Mixture-of-Experts transformer with dynamic routing and speculative decoding heads.',
                'keyCapabilities' => array(
                    'Dependable 540 tokens/sec streaming velocity.',
                    'Ultra-low inference cost: $0.03/1M input and $0.09/1M output.',
                    'Excellent performance on high-volume classification, sentiment analysis, and NER.',
                    '128k context window.'
                ),
                'benchmarks' => array(
                    'Coding Percentile' => '59%',
                    'Agentic Score' => '54%',
                    'Value Rank' => '#4 Global Value Leader',
                    'Throughput' => '540 tok/s'
                ),
                'googleSynergy' => 'Ideal for BigQuery data preparation pipelines and embedding generation workflows.',
                'samplePrompt' => 'Clean and standardize these 100 messy address strings into standard postal format.',
                'sampleOutput' => '[100 standardized address records in clean JSON array]'
            ),
            array(
                'id' => 'openai/gpt-5-6-luna',
                'name' => 'GPT-5.6 Luna (Batch)',
                'slug' => 'gpt-5-6-luna',
                'provider' => 'OpenAI',
                'providerSlug' => 'openai',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '310 tok/s',
                'ttft' => 'Batch SLA',
                'providersCount' => 18,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.10 / 1M',
                'outputPrice' => '$0.40 / 1M',
                'tagline' => '#5 Ranked in Value Leaders with 78% coding percentile and 71% agentic capability.',
                'summary' => 'GPT-5.6 Luna in Batch mode is OpenAI high-leverage efficiency engine, ranked #5 on the OpenRouter Value Leaderboard. Boasting a 78% coding percentile and 71% agentic capability, Luna gives enterprises access to next-generation OpenAI architecture at an affordable batch rate.',
                'architecture' => 'Next-generation distilled multi-modal transformer optimized for high batch concurrency and synthetic data generation.',
                'keyCapabilities' => array(
                    '78% coding percentile rivaling full-scale flagship models.',
                    '71% agentic task completion for autonomous web workflows.',
                    'Batch processing economy with 50% discount on standard OpenAI API pricing.',
                    'High output coherence and nuanced instruction adherence.'
                ),
                'benchmarks' => array(
                    'Intelligence Percentile' => '34%',
                    'Coding Percentile' => '78%',
                    'Agentic Score' => '71%',
                    'Value Rank' => '#5 Global Value Leader'
                ),
                'googleSynergy' => 'Compatible with hybrid Google Cloud storage and OpenAI Batch API ingestion workflows.',
                'samplePrompt' => 'Generate 50 synthetic test user scenarios for an automated testing framework of an airline booking engine.',
                'sampleOutput' => '[50 diverse JSON test scenarios covering booking edge cases, cancellations, and upgrades]'
            ),
            array(
                'id' => 'meta-llama/llama-3.3-70b-instruct',
                'name' => 'Llama 3.3 70B Instruct',
                'slug' => 'llama-3-3-70b-instruct',
                'provider' => 'Meta',
                'providerSlug' => 'meta',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '165 tok/s',
                'ttft' => '210ms',
                'providersCount' => 46,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.20 / 1M',
                'outputPrice' => '$0.40 / 1M',
                'tagline' => 'Meta supreme open-weights model matching the previous generation 405B model at 70B efficiency and cost.',
                'summary' => 'Llama 3.3 70B Instruct is Meta most cost-efficient high-intelligence model. By integrating advancements from the 405B training run, Meta achieved benchmark parity with the original 405B model in an efficient 70-billion parameter size. It represents the gold standard for self-hosted enterprise intelligence, tool calling, and structured JSON output.',
                'architecture' => '70-billion parameter dense transformer with Grouped-Query Attention (GQA), fine-tuned with DPO and PPO on curated synthetic datasets.',
                'keyCapabilities' => array(
                    'Matches the intelligence of Llama 3.1 405B at a fraction of the compute and memory footprint.',
                    '128,000 token context window with reliable long-context recall.',
                    'Open weights deployable on a dual-GPU server (2x RTX 3090/4090 with 4-bit AWQ).',
                    'Superb instruction-following and structured schema output guarantee.'
                ),
                'benchmarks' => array(
                    'MMLU' => '86.4% benchmark score',
                    'MATH' => '73.1% zero-shot accuracy',
                    'HumanEval' => '88.4% code generation',
                    'Context Retrieval' => '99.5% up to 128k'
                ),
                'googleSynergy' => 'Easily deployed on Google Cloud Compute Engine or GKE with vLLM for high-throughput private enterprise inference.',
                'samplePrompt' => 'Design an automated incident response runbook for a Kubernetes cluster experiencing OOMKilled pod crash loops.',
                'sampleOutput' => '[Structured incident triage runbook with kubectl diagnostics commands, Prometheus alerting metrics, and resource request tuning guidelines]'
            ),
            array(
                'id' => 'cohere/command-r-plus',
                'name' => 'Cohere Command R+',
                'slug' => 'command-r-plus',
                'provider' => 'Cohere',
                'providerSlug' => 'cohere',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '140 tok/s',
                'ttft' => '230ms',
                'providersCount' => 16,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$2.50 / 1M',
                'outputPrice' => '$10.00 / 1M',
                'tagline' => 'Enterprise foundation model purpose-built for enterprise Retrieval-Augmented Generation (RAG) with verifiable citations.',
                'summary' => 'Cohere Command R+ is engineered from the ground up for enterprise Retrieval-Augmented Generation (RAG). Unlike models that hallucinate facts or lose track of references, Command R+ outputs verifiable inline citations for every statement, allowing enterprise compliance and legal teams to trust generative outputs implicitly.',
                'architecture' => '104-billion parameter dense transformer with specialized RAG fine-tuning, multi-step tool use, and citation tokenizers.',
                'keyCapabilities' => array(
                    'Native citation generation: grounds every sentence in cited source documents with direct character-level anchors.',
                    'Multi-step tool use: orchestrates multiple external databases, search engines, and enterprise APIs in sequence.',
                    'Optimized for 10 key global business languages including Japanese, German, and Spanish.',
                    'Strict enterprise data privacy guarantees with zero training on customer prompts.'
                ),
                'benchmarks' => array(
                    'RAG Factual Accuracy' => '94.2% citation grounding score',
                    'Tool Use Benchmark' => '89.5% multi-step accuracy',
                    'MMLU' => '75.7%',
                    'Context Span' => '128k tokens'
                ),
                'googleSynergy' => 'Native deployment on Google Cloud Vertex AI with direct integration into BigQuery and Google Drive enterprise document vaults.',
                'samplePrompt' => 'Based on these 5 internal product specification documents, answer whether our microservice meets ISO 27001 encryption standards and cite exact sections.',
                'sampleOutput' => '[Clear compliance evaluation with 7 direct inline citations referencing Document A (Section 4.2) and Document C (Annex A.10)]'
            ),
            // =================================================================
            // ADDITIONAL OPENROUTER DISCOVER FRONTIER MODELS (FLAGSHIP, REASONING, CODING, MULTIMODAL, SPEED & VALUE)
            // =================================================================
            array(
                'id' => 'qwen/qwen-2.5-72b-instruct',
                'name' => 'Qwen 2.5 72B Instruct',
                'slug' => 'qwen-2-5-72b-instruct',
                'provider' => 'Qwen (Alibaba)',
                'providerSlug' => 'qwen',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '95 tok/s',
                'ttft' => '280ms',
                'providersCount' => 34,
                'inputPrice' => '$0.35 / 1M',
                'outputPrice' => '$0.40 / 1M',
                'contextWindow' => '128k',
                'tagline' => 'Open-weights powerhouse matching proprietary systems across MMLU, GPQA, and polyglot coding.',
                'summary' => 'Qwen 2.5 72B Instruct stands as one of the most capable open-weights language models globally, matching GPT-4-class systems on complex reasoning, mathematics, and multilingual comprehension across 29 languages. Trained on 18 trillion tokens with group-query attention (GQA), it provides outstanding instruction following, structured JSON extraction, and autonomous agent tool orchestration.',
                'architecture' => 'Dense 72.7-billion parameter transformer with Grouped Query Attention (GQA), RoPE positional embeddings scaled to 128k tokens, and specialized bilingual post-training RLHF.',
                'keyCapabilities' => array(
                    'Elite mathematics and theorem proving: scores 83.1% on MATH and 91.5% on GSM8K.',
                    'Production-ready JSON mode with strict adherence to complex OpenAPI schemas.',
                    'Fluent translation and linguistic nuance across 29 European, Asian, and Middle Eastern languages.',
                    'Efficient deployment footprint: fits on 2x A100/H100 80GB GPUs with FP8 or 4-bit AWQ quantization.'
                ),
                'benchmarks' => array(
                    'MMLU' => '86.1% accuracy',
                    'HumanEval' => '86.4% pass@1',
                    'MATH' => '83.1% zero-shot',
                    'GPQA Diamond' => '49.2%'
                ),
                'googleSynergy' => 'Readily deployable on Google Cloud Vertex AI Model Garden via GKE with vLLM acceleration and TensorRT-LLM runtimes.',
                'samplePrompt' => 'Draft a distributed event-driven microservices architecture in Go utilizing Kafka and Redis, detailing idempotency keys and outbox patterns.',
                'sampleOutput' => '[Exhaustive architectural blueprint with production-grade Go code illustrating transactional outbox dispatch, atomic state transitions, and deduplication tables]'
            ),
            array(
                'id' => 'x-ai/grok-2',
                'name' => 'xAI Grok 2',
                'slug' => 'grok-2',
                'provider' => 'xAI',
                'providerSlug' => 'x-ai',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '110 tok/s',
                'ttft' => '240ms',
                'providersCount' => 18,
                'inputPrice' => '$2.00 / 1M',
                'outputPrice' => '$10.00 / 1M',
                'contextWindow' => '128k',
                'tagline' => 'Frontier multimodal model with real-time world understanding and deep conversational nuance.',
                'summary' => 'Grok 2 is xAI flagship frontier intelligence foundation model, engineered with state-of-the-art vision comprehension, mathematical acuity, and contextual humor. Evaluated on the LMSYS Chatbot Arena, Grok 2 ranks among the very top frontier models globally, excelling at code generation, scientific research, and complex chart interpretation.',
                'architecture' => 'Frontier dense transformer architecture co-trained with unified visual projection encoders and advanced synthetic reasoning curriculum.',
                'keyCapabilities' => array(
                    'Top-tier Chatbot Arena ranking: consistently places in the global top 5 across human blind evaluation.',
                    'Multimodal vision analysis: parses complex diagrams, technical blueprints, and UI wireframes with high accuracy.',
                    'Real-time synthesis capabilities: synthesizes emerging trends with grounded contextual nuance.',
                    'Enterprise tool-calling: supports dynamic web search, code interpreter execution, and structured function output.'
                ),
                'benchmarks' => array(
                    'Chatbot Arena ELO' => '1295+ (Global Top 5)',
                    'MMLU' => '87.5% accuracy',
                    'HumanEval' => '88.4% pass@1',
                    'MATH' => '76.1%'
                ),
                'googleSynergy' => 'Compatible with Google Cloud multi-cloud agent orchestration pipelines and BigQuery analytical data lakes via standard OpenRouter API bridges.',
                'samplePrompt' => 'Analyze this financial balance sheet image, compute liquidity ratios, and highlight warning signs in short-term debt obligations.',
                'sampleOutput' => '[Structured breakdown detailing current ratio (1.14), quick ratio (0.82), and debt maturities due in Q3 with risk sensitivity analysis]'
            ),
            array(
                'id' => 'amazon/nova-pro-v1',
                'name' => 'Amazon Nova Pro',
                'slug' => 'amazon-nova-pro',
                'provider' => 'Amazon',
                'providerSlug' => 'amazon',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '125 tok/s',
                'ttft' => '230ms',
                'providersCount' => 12,
                'inputPrice' => '$0.80 / 1M',
                'outputPrice' => '$3.20 / 1M',
                'contextWindow' => '300k',
                'tagline' => 'High-capability multimodal frontier model engineered for enterprise document and video workflows.',
                'summary' => 'Amazon Nova Pro combines high frontier intelligence with cost-effective inference speed and a massive 300k context buffer. Built for enterprise search, multi-modal video understanding, and multi-document reasoning, it natively processes text, high-resolution imagery, and multi-minute video streams in a unified attention pass.',
                'architecture' => 'Multimodal transformer architecture optimized with cross-attention video encoders and flash-decoding kernels.',
                'keyCapabilities' => array(
                    'Massive 300,000-token context window capable of ingesting entire codebases and hour-long video files.',
                    'Deep multimodal perception: analyzes multi-frame temporal video and technical blueprints simultaneously.',
                    'Fine-tuned for enterprise compliance, guardrails, and role-based access control (RBAC) safety.',
                    'Low-cost enterprise pricing: 60% less expensive than traditional frontier commercial alternatives.'
                ),
                'benchmarks' => array(
                    'MMLU' => '84.8% accuracy',
                    'Video-MME' => '65.2% comprehension',
                    'DocVQA' => '91.4% visual QA',
                    'Context Span' => '300,000 tokens'
                ),
                'googleSynergy' => 'Can be deployed alongside Google Cloud storage buckets and Gemini multimodal pipelines for cross-cloud redundancy and high-availability enterprise routing.',
                'samplePrompt' => 'Review this 45-minute technical recording transcript and architecture diagram, and summarize all decisions made regarding schema migration.',
                'sampleOutput' => '[Clear chronologically ordered summary with identified owners, migration phases, rollback triggers, and architectural tradeoffs]'
            ),
            array(
                'id' => 'deepseek/deepseek-coder-v2.5',
                'name' => 'DeepSeek Coder V2.5',
                'slug' => 'deepseek-coder-v2-5',
                'provider' => 'DeepSeek',
                'providerSlug' => 'deepseek',
                'category' => 'coding',
                'categoryName' => 'Coding & Software Dev',
                'throughput' => '160 tok/s',
                'ttft' => '290ms',
                'providersCount' => 26,
                'inputPrice' => '$0.14 / 1M',
                'outputPrice' => '$0.28 / 1M',
                'contextWindow' => '128k',
                'tagline' => 'Fine-grained Mixture-of-Experts coding model supporting 338 programming languages and complex repos.',
                'summary' => 'DeepSeek Coder V2.5 is a frontier open-weights code intelligence model utilizing fine-grained Mixture-of-Experts (MoE) with 236B total parameters (21B activated per token). It matches closed proprietary models on SWE-Bench Lite and HumanEval while dramatically lowering API inference costs.',
                'architecture' => 'Sparse Mixture-of-Experts (MoE) with 236B parameters total, Multi-Head Latent Attention (MLA), and 128k context RoPE.',
                'keyCapabilities' => array(
                    'Broad programming language coverage: natively understands syntax and idioms across 338 programming languages.',
                    'Repository-level comprehension: navigates multi-file dependencies, abstract syntax trees, and build configurations.',
                    'SWE-Bench Lite performance: independently locates, isolates, and patches genuine GitHub software bugs.',
                    'Multi-head Latent Attention (MLA): dramatically compresses KV cache memory for high-concurrency batching.'
                ),
                'benchmarks' => array(
                    'HumanEval' => '90.2% pass@1',
                    'MBPP' => '76.2% zero-shot',
                    'SWE-Bench Lite' => '28.8% resolved',
                    'AIME 2024' => '43.3%'
                ),
                'googleSynergy' => 'Hostable on Google Cloud A3 Ultra GPU clusters with DeepSeek-optimized vLLM kernels and integration with Google Cloud Source Repositories.',
                'samplePrompt' => 'Implement an asynchronous distributed rate limiter in Rust using Token Bucket algorithm, atomic primitives, and Tokio networking.',
                'sampleOutput' => '[Zero-dependency production Rust code with atomic CAS loops, leak-free replenishment tasks, and complete unit tests]'
            ),
            array(
                'id' => 'cursor/cursor-small',
                'name' => 'Cursor Small (StarCoder 2 15B)',
                'slug' => 'cursor-small',
                'provider' => 'Cursor / BigCode',
                'providerSlug' => 'cursor',
                'category' => 'coding',
                'categoryName' => 'Coding & Software Dev',
                'throughput' => '380 tok/s',
                'ttft' => '110ms',
                'providersCount' => 16,
                'inputPrice' => '$0.10 / 1M',
                'outputPrice' => '$0.20 / 1M',
                'contextWindow' => '64k',
                'tagline' => 'Sub-100ms speculative code completion engine built for real-time IDE tab autocompletion.',
                'summary' => 'Trained specifically for interactive editor experiences, Cursor Small specializes in sub-100ms speculative code completions, multi-line edits, and instant linting fixes. Its lightweight architecture and specialized decoding schedule make it the preferred backbone for continuous developer flow states.',
                'architecture' => 'Compact 15-billion parameter code transformer with specialized fill-in-the-middle (FIM) training and fast speculative draft heads.',
                'keyCapabilities' => array(
                    'Ultra-low latency: delivers first tokens in under 110ms for instant tab-completion.',
                    'Fill-In-The-Middle (FIM) mastery: accurately predicts code insertions based on surrounding context above and below cursor.',
                    'AST-aware multi-line completions: synthesizes complete idiomatic functions and struct definitions in a single keystroke.',
                    'High developer acceptance rate in daily production IDE telemetry.'
                ),
                'benchmarks' => array(
                    'FIM Benchmark' => '88.5% precision',
                    'Latency TTFT' => '110ms',
                    'Throughput' => '380 tokens/sec',
                    'HumanEval' => '75.4%'
                ),
                'googleSynergy' => 'Deployable on cost-effective Google Cloud L4 or A100 instances for instant private enterprise code assistance behind corporate firewalls.',
                'samplePrompt' => 'Complete the following TypeScript handler function given the OpenAPI schema header and query validation parameters.',
                'sampleOutput' => '[Concise, type-safe TypeScript implementation with Zod schema validation and HTTP 400 error handling]'
            ),
            array(
                'id' => 'microsoft/phi-4',
                'name' => 'Microsoft Phi-4 14B',
                'slug' => 'phi-4',
                'provider' => 'Microsoft',
                'providerSlug' => 'microsoft',
                'category' => 'reasoning',
                'categoryName' => 'Reasoning & Agentic',
                'throughput' => '185 tok/s',
                'ttft' => '190ms',
                'providersCount' => 22,
                'inputPrice' => '$0.07 / 1M',
                'outputPrice' => '$0.14 / 1M',
                'contextWindow' => '16k',
                'tagline' => 'Synthetic-data trained 14B reasoning powerhouse outperforming models 5x its parameter count on MATH.',
                'summary' => 'Microsoft Phi-4 is a state-of-the-art 14-billion parameter language model that demonstrates the transformative power of curriculum-driven synthetic data. Despite its modest size, Phi-4 rivals or outperforms models with 70B+ parameters across MATH, GSM8K, and GPQA, setting the gold standard for small reasoning models.',
                'architecture' => 'Dense 14.7-billion parameter transformer trained with curriculum-guided synthetic reasoning data and DPO alignment.',
                'keyCapabilities' => array(
                    'World-class mathematical reasoning: scores 84.8% on MATH and 95.2% on GSM8K.',
                    'Phenomenal parameter efficiency: achieves 70B-grade intelligence within a 14B parameter memory footprint.',
                    'Fast inference and edge deployability: runs smoothly on local MacBooks, developer laptops, and single GPUs.',
                    'Strict safety and refusal alignment preserving factual objectivity.'
                ),
                'benchmarks' => array(
                    'MATH' => '84.8% zero-shot',
                    'GSM8K' => '95.2%',
                    'MMLU' => '84.4%',
                    'GPQA' => '42.6%'
                ),
                'googleSynergy' => 'Runs natively in Google Cloud Run or GKE on low-cost T4 or L4 GPUs, providing economical high-intelligence reasoning microservices.',
                'samplePrompt' => 'Solve the functional equation: find all functions f: R -> R such that f(x*y) = f(x)*f(y) - f(x+y) + 1 for all real x, y.',
                'sampleOutput' => '[Rigorous mathematical derivation demonstrating that the only non-trivial solutions are f(x) = x + 1 and f(x) = 1]'
            ),
            array(
                'id' => 'deepseek/deepseek-r1-distill-qwen-32b',
                'name' => 'DeepSeek R1 Distill Qwen 32B',
                'slug' => 'deepseek-r1-distill-qwen-32b',
                'provider' => 'DeepSeek / Qwen',
                'providerSlug' => 'deepseek',
                'category' => 'reasoning',
                'categoryName' => 'Reasoning & Agentic',
                'throughput' => '140 tok/s',
                'ttft' => '260ms',
                'providersCount' => 30,
                'inputPrice' => '$0.18 / 1M',
                'outputPrice' => '$0.36 / 1M',
                'contextWindow' => '128k',
                'tagline' => 'Distilled reasoning model capturing the deep thinking trajectories of DeepSeek-R1 in 32B parameters.',
                'summary' => 'DeepSeek R1 Distill Qwen 32B distills the reinforcement-learning chain-of-thought trajectories of the flagship 671B DeepSeek-R1 into Qwen 2.5 32B architecture. It matches OpenAI o1-mini on competitive coding and AIME 2024 mathematics while offering open weights and fully transparent reasoning tokens.',
                'architecture' => 'Dense 32.5-billion parameter transformer trained on 800,000 verified reasoning trajectories distilled from DeepSeek-R1.',
                'keyCapabilities' => array(
                    'Verifiable chain of thought: outputs explicit <think> tokens illustrating every step of deduction.',
                    'Olympiad mathematics mastery: achieves 72.6% on AIME 2024 and 94.3% on MATH 500.',
                    'Competitive code generation: outperforms Claude 3.5 Sonnet on Codeforces competition problems.',
                    'Economical deployment: runs comfortably in 4-bit/8-bit precision on a single workstation or server GPU.'
                ),
                'benchmarks' => array(
                    'AIME 2024' => '72.6% pass@1',
                    'MATH 500' => '94.3%',
                    'Codeforces ELO' => '1691 rating',
                    'MMLU' => '87.4%'
                ),
                'googleSynergy' => 'Deployable on Google Cloud Vertex AI Custom Models with dynamic token streaming to display live thinking blocks in user web interfaces.',
                'samplePrompt' => 'A fair coin is flipped until 3 consecutive heads appear. Calculate the expected number of total flips and prove your result using Markov chains.',
                'sampleOutput' => '[Detailed <think> trace setting up transition states E = 1/2(E+1) + 1/4(E+2) + 1/8(3) and proving expected flips E = 14]'
            ),
            array(
                'id' => 'deepseek/deepseek-r1-distill-llama-70b',
                'name' => 'DeepSeek R1 Distill Llama 70B',
                'slug' => 'deepseek-r1-distill-llama-70b',
                'provider' => 'DeepSeek / Meta',
                'providerSlug' => 'deepseek',
                'category' => 'reasoning',
                'categoryName' => 'Reasoning & Agentic',
                'throughput' => '95 tok/s',
                'ttft' => '310ms',
                'providersCount' => 28,
                'inputPrice' => '$0.28 / 1M',
                'outputPrice' => '$0.56 / 1M',
                'contextWindow' => '128k',
                'tagline' => 'Enterprise-grade distilled reasoning engine built on Meta Llama 3.3 70B foundation.',
                'summary' => 'Combining the proven stability of Meta Llama 3.3 70B with DeepSeek-R1 deliberate step-by-step thinking distillation, this model represents one of the strongest open-weights reasoning systems available. It delivers exceptional performance across formal logic, legal analysis, and STEM research.',
                'architecture' => 'Dense 70.6-billion parameter Llama 3 architecture fine-tuned with 800k curated DeepSeek-R1 thinking traces and DPO.',
                'keyCapabilities' => array(
                    'Robust reasoning across complex domains: handles multi-page technical proofs, legal contracts, and financial simulations.',
                    'Elite benchmark performance: scores 70.0% on AIME 2024 and 94.5% on MATH 500.',
                    'Native Llama ecosystem compatibility: drop-in compatible with all standard Llama-3 tooling, Ollama, and vLLM.',
                    'Transparent self-correction: catches logical fallacies and edge cases during its extended thinking phase.'
                ),
                'benchmarks' => array(
                    'MATH 500' => '94.5% pass@1',
                    'AIME 2024' => '70.0%',
                    'GPQA Diamond' => '54.5%',
                    'MMLU' => '88.3%'
                ),
                'googleSynergy' => 'Compatible with Google Cloud TPU v5e pods and Vertex AI Model Garden for enterprise-scale private reasoning engines.',
                'samplePrompt' => 'Analyze the legal implications of an arbitration clause in an SaaS terms-of-service contract under current EU consumer protection directives.',
                'sampleOutput' => '[Deep reasoning chain analyzing Council Directive 93/13/EEC, CJEU precedent rulings, and drafting compliant alternative dispute clauses]'
            ),
            array(
                'id' => 'openai/whisper-large-v3-turbo',
                'name' => 'Whisper Large v3 Turbo',
                'slug' => 'whisper-large-v3-turbo',
                'provider' => 'OpenAI',
                'providerSlug' => 'openai',
                'category' => 'speech',
                'categoryName' => 'Speech & Audio',
                'throughput' => '350 tok/s',
                'ttft' => '120ms',
                'providersCount' => 25,
                'inputPrice' => '$0.006 / min',
                'outputPrice' => 'Included',
                'contextWindow' => '30s / stream',
                'tagline' => 'Pruned sequence-to-sequence audio foundation model delivering 8x faster transcription and translation.',
                'summary' => 'Whisper Large v3 Turbo is OpenAI optimized speech recognition foundation model, reducing the decoder layers from 32 down to 4. It maintains the world-class word error rate (WER) of Whisper Large v3 while running up to 8x faster, making it the premier choice for large-scale audio transcription.',
                'architecture' => 'Encoder-decoder audio transformer with 32 encoder layers and 4 pruned decoder layers trained on 5 million hours of multilingual audio.',
                'keyCapabilities' => array(
                    'Unmatched multilingual coverage: transcribes and translates speech across 99 languages with automatic language identification.',
                    '8x faster inference speed: transcribes hour-long audio files in seconds on modern GPU hardware.',
                    'Acoustic robustness: reliably filters heavy background noise, microphone distortion, and overlapping speakers.',
                    'Precise word-level timestamps for seamless subtitle and caption alignment.'
                ),
                'benchmarks' => array(
                    'WER (English)' => '7.5% word error rate',
                    'Multilingual WER' => '10.2% average across 99 langs',
                    'Inference Speed' => '8x faster than Large v3',
                    'Real-Time Factor' => '0.015 RTF'
                ),
                'googleSynergy' => 'Seamlessly paired with Google Cloud Speech-to-Text pipelines and BigQuery audio metadata analysis pipelines.',
                'samplePrompt' => 'Transcribe this noisy 10-minute conference call with French and English speakers and output timestamped VTT captions.',
                'sampleOutput' => '[Formatted WebVTT output with sub-second timestamps, speaker tags, and phonetically accurate multilingual transcript]'
            ),
            array(
                'id' => 'cartesia/cartesia-sonic',
                'name' => 'Cartesia Sonic Voice',
                'slug' => 'cartesia-sonic',
                'provider' => 'Cartesia',
                'providerSlug' => 'cartesia',
                'category' => 'speech',
                'categoryName' => 'Speech & Audio',
                'throughput' => '120 tok/s',
                'ttft' => '90ms',
                'providersCount' => 15,
                'inputPrice' => '$0.015 / min',
                'outputPrice' => 'Included',
                'contextWindow' => 'Real-time',
                'tagline' => 'State space model (SSM) voice engine delivering lifelike speech with sub-100ms latency.',
                'summary' => 'Powered by novel State Space Models (SSMs), Cartesia Sonic is engineered from the ground up for real-time conversational AI. Achieving time-to-first-audio latency under 90 milliseconds, it enables fluid, human-like voice conversations that support natural interruptions and expressive emotional tone.',
                'architecture' => 'State Space Model (SSM) acoustic backbone with streaming neural audio vocoders and low-rank voice conditioning.',
                'keyCapabilities' => array(
                    'Sub-90ms time-to-first-audio (TTFA): eliminates awkward conversational pauses in AI voice bots.',
                    'Emotionally expressive speech synthesis: adapts pitch, pacing, and breath sounds dynamically based on semantic context.',
                    'Zero-shot voice cloning: replicates speaker timbre and prosody from a brief 5-second audio sample.',
                    'Built-in bi-directional streaming WebSocket protocol for telephony and mobile SDKs.'
                ),
                'benchmarks' => array(
                    'TTFA Latency' => '85ms median',
                    'Audio Quality MOS' => '4.55 / 5.0 Mean Opinion Score',
                    'Language Support' => '15 languages',
                    'Sample Rate' => '24kHz 16-bit PCM'
                ),
                'googleSynergy' => 'Integrates seamlessly with Google Cloud Contact Center AI (CCAI) and Vertex AI live streaming agent endpoints.',
                'samplePrompt' => 'Generate empathetic customer support audio explaining a delayed flight with genuine reassurance and natural pauses.',
                'sampleOutput' => '[Streaming 24kHz audio stream with warm conversational tone, gentle pacing, and lifelike breath modulations]'
            ),
            array(
                'id' => 'runway/runway-gen-3-alpha',
                'name' => 'Runway Gen-3 Alpha Turbo',
                'slug' => 'runway-gen-3-alpha',
                'provider' => 'Runway',
                'providerSlug' => 'runway',
                'category' => 'video',
                'categoryName' => 'Video Generation',
                'throughput' => '7x real-time',
                'ttft' => '3.2s',
                'providersCount' => 14,
                'inputPrice' => '$0.05 / sec',
                'outputPrice' => 'Included',
                'contextWindow' => '10s clips',
                'tagline' => 'Industry-standard cinematic video generation model with fine-grained directorial camera control.',
                'summary' => 'Runway Gen-3 Alpha Turbo is a frontier video diffusion model trained jointly on video and image representations. It offers precise directorial control over camera pan, tilt, zoom, and dynamic character choreography, making it the industry standard for Hollywood VFX, advertising, and indie filmmaking.',
                'architecture' => 'Spatio-temporal video diffusion transformer trained with motion brush conditioning and optical flow constraints.',
                'keyCapabilities' => array(
                    'Cinematic camera control: specifies exact camera tracking, drone sweeps, rack focuses, and dolly movements.',
                    'Consistent human character motion: preserves facial identity, clothing textures, and limb kinematics across 10-second takes.',
                    'Motion Brush: allows creators to paint specific areas of an image and dictate directional velocity vectors.',
                    'Turbo generation speed: generates high-definition video clips 7x faster than Gen-2.'
                ),
                'benchmarks' => array(
                    'Resolution' => '1080p Full HD (60fps output)',
                    'Temporal Consistency' => '94.2% structural retention',
                    'Generation Time' => '18 seconds for 10s video',
                    'Motion Realism Score' => '4.6 / 5.0'
                ),
                'googleSynergy' => 'Pairs with Google Cloud Cloud Storage (GCS) high-speed video buckets and Vertex AI generative media workflows.',
                'samplePrompt' => 'Cinematic drone shot flying through a rain-soaked neon cyberpunk alley in Tokyo, camera swoops downward passing a steaming ramen shop.',
                'sampleOutput' => '[Hyper-realistic 1080p 60fps MP4 video featuring volumetric rain reflections, lens flares, and physically accurate camera momentum]'
            ),
            array(
                'id' => 'luma/luma-dream-machine',
                'name' => 'Luma Dream Machine 1.5',
                'slug' => 'luma-dream-machine',
                'provider' => 'Luma AI',
                'providerSlug' => 'luma',
                'category' => 'video',
                'categoryName' => 'Video Generation',
                'throughput' => '5x real-time',
                'ttft' => '4.1s',
                'providersCount' => 12,
                'inputPrice' => '$0.04 / sec',
                'outputPrice' => 'Included',
                'contextWindow' => '5s clips',
                'tagline' => 'High-speed spatio-temporal video transformer delivering fluid motion and camera choreography.',
                'summary' => 'Luma Dream Machine 1.5 is a highly scalable spatio-temporal video transformer trained directly on video representations. It excels at synthesizing dynamic physics, splashing liquids, fabric drape, and complex camera movements with remarkable realism.',
                'architecture' => 'Unified video transformer predicting 3D scene geometry and temporal motion vectors simultaneously.',
                'keyCapabilities' => array(
                    'Accurate physical dynamics: correctly simulates gravity, inertia, fluid splashes, and light interaction.',
                    'Text-to-video and image-to-video: effortlessly animates still concept art into fluid cinematic video sequences.',
                    'Keyframe interpolation: seamlessly bridges start and end keyframes with natural, believable motion arcs.',
                    'Fast iteration cycles: produces initial preview renders in seconds for rapid creative exploration.'
                ),
                'benchmarks' => array(
                    'Physical Accuracy' => '91.8% human evaluation rating',
                    'Resolution' => '720p/1080p upscale',
                    'Frame Rate' => '24fps cinematic motion',
                    'Rendering Speed' => '5x faster than baseline diffusion'
                ),
                'googleSynergy' => 'Integrates into Google Workspace media pipelines and automated video creation scripts hosted on Google Cloud Run.',
                'samplePrompt' => 'A glass sphere drops onto a marble table in slow motion, shattering into hundreds of reflective fragments with light bouncing off each piece.',
                'sampleOutput' => '[Cinematic 5-second video render demonstrating physically accurate fracture dynamics, refraction, and shadow casting]'
            ),
            array(
                'id' => 'tencent/hunyuan-video',
                'name' => 'Tencent Hunyuan Video',
                'slug' => 'hunyuan-video',
                'provider' => 'Tencent',
                'providerSlug' => 'tencent',
                'category' => 'video',
                'categoryName' => 'Video Generation',
                'throughput' => '3x real-time',
                'ttft' => '5.5s',
                'providersCount' => 16,
                'inputPrice' => '$0.03 / sec',
                'outputPrice' => 'Included',
                'contextWindow' => '128 frames',
                'tagline' => 'Open-source 13B parameter video diffusion transformer rivaling leading closed commercial systems.',
                'summary' => 'Hunyuan Video is the largest open-source video generation model available, featuring a 13-billion parameter dual-stream Diffusion Transformer (DiT). It matches or surpasses closed models in motion quality, prompt alignment, and structural stability, giving the developer community open access to frontier video generation.',
                'architecture' => 'Dual-stream Diffusion Transformer (DiT) with 13B parameters, 3D VAE compression, and joint text-video cross-attention.',
                'keyCapabilities' => array(
                    'Full open weights release: enables self-hosting, custom LoRA fine-tuning, and on-premises video generation.',
                    'Dual-stream text processing: leverages both MLLM and standard text encoders for precise prompt comprehension.',
                    'Temporal stability: eliminates flickering artifacts and unnatural morphing across extended 128-frame clips.',
                    'High cinematic resolution: natively outputs at 720p with upscaling pipelines supporting 4K.'
                ),
                'benchmarks' => array(
                    'VBench Total' => '84.5% overall quality score',
                    'Motion Smoothness' => '97.2%',
                    'Dynamic Degree' => '83.1%',
                    'Parameter Count' => '13 Billion'
                ),
                'googleSynergy' => 'Can be deployed on Google Cloud A3 Ultra GPU clusters with distributed DeepSpeed inference and TensorRT-LLM acceleration.',
                'samplePrompt' => 'An astronaut walking on the red sand dunes of Mars during a dust storm, looking back as rover tracks fade in the wind.',
                'sampleOutput' => '[Fluid 720p video clip showing dust particles reacting to wind currents and realistic space suit fabric movement]'
            ),
            array(
                'id' => 'bfl/flux-1-schnell',
                'name' => 'FLUX.1 Schnell',
                'slug' => 'flux-1-schnell',
                'provider' => 'Black Forest Labs',
                'providerSlug' => 'bfl',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '950ms gen',
                'ttft' => '400ms',
                'providersCount' => 35,
                'inputPrice' => '$0.003 / img',
                'outputPrice' => 'Included',
                'contextWindow' => '1024x1024',
                'tagline' => '12-billion parameter rectified flow transformer generating photorealistic images in 1 to 4 steps.',
                'summary' => 'Created by the original inventors of Stable Diffusion, FLUX.1 Schnell is an ultra-distilled 12-billion parameter flow-matching model. It produces breathtaking photographic imagery, accurate human anatomy, and crisp typography in just 1 to 4 denoising steps, completing full renders in under 1 second.',
                'architecture' => '12B parameter multimodal rectified flow transformer with rotary position embeddings and parallel text-image attention streams.',
                'keyCapabilities' => array(
                    'Sub-second generation: completes full 1024x1024 renders in under 950ms on standard enterprise GPUs.',
                    'Exceptional text rendering: writes legible, stylistically integrated words, street signs, and book covers without spelling errors.',
                    'Anatomical perfection: accurately renders human fingers, hands, teeth, and intricate clothing folds.',
                    'Ultra-low API cost: at $0.003 per generation, it provides 10x better cost economics than legacy image models.'
                ),
                'benchmarks' => array(
                    'Inference Steps' => '1 to 4 steps',
                    'Generation Latency' => '950ms median',
                    'Typography Accuracy' => '92.4% exact match',
                    'Human Anatomy Score' => '95.1%'
                ),
                'googleSynergy' => 'Runs with maximum efficiency on Google Cloud L4 GPUs using Hugging Face Diffusers or ComfyUI headless microservices.',
                'samplePrompt' => 'A vintage coffee shop storefront in Edinburgh on a rainy evening, warm interior glow, neon sign reading "Midnight Brew" in cursive.',
                'sampleOutput' => '[Photorealistic 1024x1024 visual render with glowing neon text, rain streak refractions, and authentic cobblestone reflections]'
            ),
            array(
                'id' => 'bfl/flux-1-dev',
                'name' => 'FLUX.1 Dev',
                'slug' => 'flux-1-dev',
                'provider' => 'Black Forest Labs',
                'providerSlug' => 'bfl',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '2.4s gen',
                'ttft' => '600ms',
                'providersCount' => 32,
                'inputPrice' => '$0.025 / img',
                'outputPrice' => 'Included',
                'contextWindow' => '2048x2048',
                'tagline' => 'Open-weight guidance-distilled flow transformer with peerless typography and prompt alignment.',
                'summary' => 'FLUX.1 Dev is the guidance-distilled flagship variant of Black Forest Labs flow transformer. Designed for professional creators, concept artists, and commercial advertising agencies, it delivers unparalleled adherence to highly complex multi-subject prompts and unmatched artistic versatility.',
                'architecture' => '12B parameter flow transformer trained with guidance distillation and 28-step trajectory refinement.',
                'keyCapabilities' => array(
                    'Flawless prompt adherence: coordinates multiple subjects, color palettes, and lighting conditions precisely as described.',
                    'Peerless micro-detail: captures skin pores, individual fabric threads, metallic sheen, and architectural details.',
                    'Extensive LoRA fine-tuning ecosystem: thousands of community fine-tunes available for styles, products, and characters.',
                    'Non-commercial open weights license with commercial API endpoints available globally.'
                ),
                'benchmarks' => array(
                    'Prompt Alignment' => '96.2% human preference',
                    'Visual Quality ELO' => '1180+ (Top ranked open image model)',
                    'Typography Precision' => '95.8%',
                    'Resolution' => 'Up to 2048x2048 native'
                ),
                'googleSynergy' => 'Compatible with Google Cloud Vertex AI custom endpoints for enterprise brand asset creation and marketing automation.',
                'samplePrompt' => 'An editorial portrait of a marine biologist holding a bioluminescent jellyfish, studio lighting, Hasselblad 100mm lens, f/2.8, shallow depth of field.',
                'sampleOutput' => '[Masterpiece-grade portrait with translucent jellyfish tentacles illuminating wet skin textures and authentic optical bokeh]'
            ),
            array(
                'id' => 'midjourney/midjourney-v6-1',
                'name' => 'Midjourney v6.1 Turbo',
                'slug' => 'midjourney-v6-1',
                'provider' => 'Midjourney',
                'providerSlug' => 'midjourney',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '3.1s gen',
                'ttft' => '800ms',
                'providersCount' => 10,
                'inputPrice' => '$0.04 / img',
                'outputPrice' => 'Included',
                'contextWindow' => 'Up to 4K',
                'tagline' => 'Aesthetic fidelity and cinematic lighting engine with advanced coherence and micro-detail rendering.',
                'summary' => 'Midjourney v6.1 is the world most celebrated aesthetic image generation engine, upgraded with enhanced coherence, refined hand anatomy, realistic skin textures, and reduced artifacting. Its artistic intuition and cinematic lighting make it the preferred tool for creative directors worldwide.',
                'architecture' => 'Proprietary multimodal diffusion architecture with advanced aesthetic preference reinforcement learning (RLHF).',
                'keyCapabilities' => array(
                    'Unrivaled aesthetic intuition: produces captivating cinematic compositions with minimal prompt engineering.',
                    'Refined anatomical precision: fixes common AI hand distortions, ear geometries, and facial symmetries.',
                    'Advanced inpainting and outpainting: seamlessly expands canvases or re-renders localized scene elements.',
                    'Style Reference and Character Consistency: maintains consistent fictional characters across different poses and scenes.'
                ),
                'benchmarks' => array(
                    'Aesthetic Human Preference' => '95.4% win rate against baseline diffusion',
                    'Detail Coherence' => '93.1%',
                    'Resolution' => 'Native upscaling to 4096x4096',
                    'Artistic Variety' => 'Mastery across 200+ artistic movements'
                ),
                'googleSynergy' => 'Asset output easily ingested into Google Drive creative workflows and Google Ads creative campaign libraries.',
                'samplePrompt' => 'Cinematic wide angle still of an ancient library carved inside a Himalayan cavern, sunbeams piercing through mist, scrolls glowing with golden runes.',
                'sampleOutput' => '[Breathtaking cinematic image with atmospheric volumetric lighting, stone masonry textures, and intricate calligraphic details]'
            ),
            array(
                'id' => 'cerebras/cerebras-llama-3.3-70b',
                'name' => 'Cerebras Llama 3.3 70B',
                'slug' => 'cerebras-llama-3-3-70b',
                'provider' => 'Cerebras / Meta',
                'providerSlug' => 'cerebras',
                'category' => 'fastest',
                'categoryName' => 'Fastest Models',
                'throughput' => '2,100 tok/s',
                'ttft' => '110ms',
                'providersCount' => 8,
                'inputPrice' => '$0.60 / 1M',
                'outputPrice' => '$0.60 / 1M',
                'contextWindow' => '128k',
                'tagline' => 'Wafer-Scale CS-3 engine generating over 2,100 tokens per second for real-time agentic reasoning.',
                'summary' => 'Running on Cerebras massive Wafer-Scale Engine (CS-3), this deployment of Llama 3.3 70B shatters traditional memory bandwidth bottlenecks to produce over 2,100 output tokens per second. It allows multi-step autonomous agents to complete dozens of internal reasoning loops in under one second.',
                'architecture' => 'Llama 3.3 70B foundation model compiled directly onto the Cerebras CS-3 Wafer-Scale Engine containing 900,000 AI cores on a single silicon wafer.',
                'keyCapabilities' => array(
                    'Extreme inference speed: delivers 2,100+ tokens per second, 20x faster than traditional GPU clusters.',
                    'Real-time agentic reflection: enables complex autonomous agents to execute multi-step tool calls instantaneously.',
                    'Deterministic latency: eliminates queuing jitter and erratic batch delays.',
                    'Full 70B frontier intelligence: no quantization degradation, running in full 16-bit precision.'
                ),
                'benchmarks' => array(
                    'Output Throughput' => '2,140 tokens/second',
                    'Time to First Token' => '110ms',
                    'Speedup vs H100' => '22x faster per user stream',
                    'MMLU' => '86.0%'
                ),
                'googleSynergy' => 'Can be queried directly from Google Cloud Run services to power voice-activated AI interfaces and real-time copilot widgets.',
                'samplePrompt' => 'Produce an exhaustive 1,500-word comparative analysis of relational databases vs document stores for banking ledger systems.',
                'sampleOutput' => '[Complete 1,500-word structured technical essay generated in less than 800 milliseconds]'
            ),
            array(
                'id' => 'groq/groq-llama-3.1-8b',
                'name' => 'Groq Llama 3.1 8B',
                'slug' => 'groq-llama-3-1-8b',
                'provider' => 'Groq / Meta',
                'providerSlug' => 'groq',
                'category' => 'fastest',
                'categoryName' => 'Fastest Models',
                'throughput' => '880 tok/s',
                'ttft' => '85ms',
                'providersCount' => 14,
                'inputPrice' => '$0.05 / 1M',
                'outputPrice' => '$0.08 / 1M',
                'contextWindow' => '128k',
                'tagline' => 'Language Processing Unit (LPU) powered ultra-fast inference delivering instantaneous conversational flow.',
                'summary' => 'Groq Llama 3.1 8B harnesses custom deterministic Language Processing Units (LPUs) to generate 880 tokens per second with an astonishing 85ms TTFT. It makes AI chat feel like an instantaneous conversation, transforming customer support, voice bots, and live search autocomplete.',
                'architecture' => 'Meta Llama 3.1 8B transformer deployed across Groq deterministic tensor-streaming LPUs with SRAM-only memory interconnect.',
                'keyCapabilities' => array(
                    'Blistering 880 tok/s output: streams words faster than human reading speed.',
                    'Ultra-low TTFT: 85 milliseconds from request to first byte.',
                    'Ideal for real-time voice applications: pairs with Whisper and Cartesia for zero-latency spoken dialog.',
                    'Rock-bottom cost: $0.05 per million input tokens with 128k context.'
                ),
                'benchmarks' => array(
                    'Throughput' => '880 tokens/sec',
                    'Time to First Token' => '85ms median',
                    'MMLU' => '69.4%',
                    'HumanEval' => '72.6%'
                ),
                'googleSynergy' => 'Provides instant front-end responses for Google Cloud web applications while routing complex analytical tasks to Gemini Pro in the background.',
                'samplePrompt' => 'Quickly brainstorm 10 catchy brand names for an AI-powered renewable energy forecasting startup with one-sentence rationales.',
                'sampleOutput' => '[Complete 10-item list rendered instantaneously within 120 milliseconds]'
            ),
            array(
                'id' => 'openai/gpt-4o-mini',
                'name' => 'OpenAI GPT-4o Mini',
                'slug' => 'gpt-4o-mini',
                'provider' => 'OpenAI',
                'providerSlug' => 'openai',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '190 tok/s',
                'ttft' => '190ms',
                'providersCount' => 38,
                'inputPrice' => '$0.15 / 1M',
                'outputPrice' => '$0.60 / 1M',
                'contextWindow' => '128k',
                'tagline' => 'Affordable multimodal small foundation model surpassing GPT-3.5 Turbo across all benchmarks.',
                'summary' => 'OpenAI GPT-4o Mini is an ultra-cost-effective small foundation model engineered to make frontier intelligence ubiquitously accessible. Scoring 82.0% on MMLU, it outperforms older flagship models like GPT-3.5 Turbo and Claude 3 Haiku at a fraction of their inference cost, featuring native vision perception and 128k context.',
                'architecture' => 'Efficient multimodal dense transformer co-trained on text and vision modalities with distilled post-training alignment.',
                'keyCapabilities' => array(
                    'High intelligence per dollar: 82.0% MMLU at just $0.15 per million input tokens.',
                    'Native multimodal input: processes images, screenshots, diagrams, and invoices directly.',
                    'Superior function calling and JSON output for autonomous API agents.',
                    'Prompt caching discounts: 50% discount on cached input tokens for recurring contexts.'
                ),
                'benchmarks' => array(
                    'MMLU' => '82.0% accuracy',
                    'HumanEval' => '87.2% pass@1',
                    'MATH' => '70.2%',
                    'MGSM' => '87.0%'
                ),
                'googleSynergy' => 'Easily incorporated into Google Cloud multi-LLM routing frameworks to process high-volume routine user queries affordably.',
                'samplePrompt' => 'Classify customer support feedback into billing, technical, or feature request categories and output a structured JSON array.',
                'sampleOutput' => '[Clean JSON array mapping user tickets to sentiment scores, assigned department tags, and recommended SLA urgency]'
            ),
            array(
                'id' => 'anthropic/claude-3-5-haiku',
                'name' => 'Claude 3.5 Haiku',
                'slug' => 'claude-3-5-haiku',
                'provider' => 'Anthropic',
                'providerSlug' => 'anthropic',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '170 tok/s',
                'ttft' => '210ms',
                'providersCount' => 32,
                'inputPrice' => '$0.80 / 1M',
                'outputPrice' => '$4.00 / 1M',
                'contextWindow' => '200k',
                'tagline' => 'Next-generation fast model matching Claude 3 Opus intelligence on coding and tool use.',
                'summary' => 'Anthropic Claude 3.5 Haiku brings next-generation intelligence to the low-latency speed tier. Demonstrating remarkable improvements on coding benchmarks (HumanEval 75.9%), it rivals previous flagship models like Claude 3 Opus while executing tasks at lightning speed with a full 200,000-token context window.',
                'architecture' => 'High-throughput transformer architecture optimized for fast inference, low KV-cache pressure, and precise tool calling.',
                'keyCapabilities' => array(
                    'Opus-level intelligence in a lightweight model: matches Claude 3 Opus across coding and reasoning benchmarks.',
                    'Fast agentic execution: navigates multiple tool APIs and structured schemas with minimal latency.',
                    '200k context window: digests books, multi-file codebases, and financial prospectuses in a single query.',
                    'Anthropic Computer Use compatible: can interact with desktop GUIs, clicks, and keystrokes.'
                ),
                'benchmarks' => array(
                    'MMLU' => '80.9% accuracy',
                    'HumanEval' => '75.9% pass@1',
                    'MATH' => '69.2%',
                    'GPQA' => '41.6%'
                ),
                'googleSynergy' => 'Available natively via Google Cloud Vertex AI with standard Anthropic SDK integration and enterprise IAM security.',
                'samplePrompt' => 'Review this Git diff of 12 files, check for race conditions in mutex usage, and suggest idiomatic concurrent Go fixes.',
                'sampleOutput' => '[Fast, comprehensive code review isolating potential deadlock in concurrent map access with refactored sync.RWMutex implementation]'
            ),
            array(
                'id' => 'google/gemini-1.5-flash-8b',
                'name' => 'Gemini 1.5 Flash 8B',
                'slug' => 'gemini-1-5-flash-8b',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '240 tok/s',
                'ttft' => '150ms',
                'providersCount' => 28,
                'inputPrice' => '$0.0375 / 1M',
                'outputPrice' => '$0.15 / 1M',
                'contextWindow' => '1M tokens',
                'tagline' => 'High-volume, sub-penny multimodal model featuring a massive 1-million-token context window.',
                'summary' => 'Google Gemini 1.5 Flash 8B is Google most economical foundation model, designed for massive multimodal scale and developer efficiency. Offering a 1-million-token context window at an astonishing $0.0375 per million input tokens, it makes processing entire libraries of PDFs, videos, and transcripts cost practically nothing.',
                'architecture' => 'Compact 8-billion parameter multimodal Mixture-of-Experts with flash-attention linear context scaling up to 1M tokens.',
                'keyCapabilities' => array(
                    'Massive 1M token context window: processes 1,500 pages of text, 1 hour of video, or 10 hours of audio in one prompt.',
                    'Unmatched pricing economics: $0.0375 / 1M input tokens, the most affordable frontier model in existence.',
                    'Sub-penny context caching: store massive documents permanently in context cache for $0.01 / million tokens / hour.',
                    'Ultra-fast multimodal processing across text, images, video, and audio streams.'
                ),
                'benchmarks' => array(
                    'Context Capacity' => '1,000,000 tokens',
                    'MMLU' => '71.5% accuracy',
                    'Input Price' => '$0.0375 / 1M (Cheapest globally)',
                    'Throughput' => '240 tokens/sec'
                ),
                'googleSynergy' => 'Native flagship foundation model of Google Cloud Vertex AI, offering automatic BigQuery vector search integration and enterprise data protection.',
                'samplePrompt' => 'Summarize all 24 chapters of this 400-page historical book and cross-reference key economic factors leading to the industrial revolution.',
                'sampleOutput' => '[Exhaustive chapter-by-chapter synthesis analyzing agricultural output surpluses, coal transportation networks, and patent protections]'
            ),
            array(
                'id' => 'mistralai/mistral-nemo',
                'name' => 'Mistral NeMo 12B',
                'slug' => 'mistral-nemo',
                'provider' => 'Mistral AI / NVIDIA',
                'providerSlug' => 'mistralai',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '150 tok/s',
                'ttft' => '220ms',
                'providersCount' => 24,
                'inputPrice' => '$0.15 / 1M',
                'outputPrice' => '$0.15 / 1M',
                'contextWindow' => '128k',
                'tagline' => 'Collaborative 12B model by Mistral and NVIDIA with Tekken tokenizer and 128k context.',
                'summary' => 'Built in close collaboration between Mistral AI and NVIDIA, Mistral NeMo 12B incorporates the advanced Tekken tokenizer for world-class compression across 100+ languages and programming code. It fits easily onto a single standard GPU while rivaling or surpassing older 13B to 30B models.',
                'architecture' => '12.2-billion parameter transformer trained jointly with NVIDIA using Tekken 128k BPE tokenizer and FP8 optimization.',
                'keyCapabilities' => array(
                    'Tekken Tokenizer: compresses English, Asian, and European languages 30% more efficiently than older Byte-Pair Encoding.',
                    'Drop-in single GPU replacement: runs seamlessly on a single NVIDIA RTX 4090 or Google Cloud L4 instance.',
                    'Apache 2.0 open license: completely free for commercial deployment and fine-tuning.',
                    'Strong multilingual code and logic capabilities outperforming Llama 3 8B.'
                ),
                'benchmarks' => array(
                    'MMLU' => '68.0% accuracy',
                    'HumanEval' => '71.2% pass@1',
                    'Tokenizer Efficiency' => '30% higher token compression',
                    'Context Window' => '128,000 tokens'
                ),
                'googleSynergy' => 'Deploys seamlessly on Google Cloud Run via Ollama or vLLM container images for cost-effective microservice hosting.',
                'samplePrompt' => 'Write a Python FastAPI service that ingests incoming webhooks, validates HMAC signatures, and enqueues jobs into Celery.',
                'sampleOutput' => '[Complete, production-grade FastAPI microservice with cryptographic timing-attack mitigation and Redis Celery integration]'
            ),
            // =================================================================
            // 9. EXTENDED FRONTIER LABS & FOUNDATION ARCHITECTURES
            // =================================================================
            array(
                'id' => 'google/gemma-2-27b',
                'name' => 'Gemma 2 27B',
                'slug' => 'gemma-2-27b',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '95 tok/s',
                'ttft' => '240ms',
                'providersCount' => 19,
                'contextWindow' => '8k tokens',
                'inputPrice' => '$0.27 / 1M',
                'outputPrice' => '$0.27 / 1M',
                'tagline' => 'Google open-weights powerhouse delivering flagship-grade reasoning on a single TPU or workstation GPU.',
                'summary' => 'Built upon the same research and technology used to create Gemini, Gemma 2 27B offers extraordinary performance per parameter. Featuring an alternating sliding window and global self-attention architecture trained with logit soft-capping and knowledge distillation, it outperforms models more than double its size.',
                'architecture' => 'Dense 27.2B parameter decoder-only transformer with grouped-query attention (GQA), logit soft-capping, and post-norm architecture.',
                'keyCapabilities' => array(
                    'Full open weights under permissive commercial terms for self-hosting and private enterprise fine-tuning.',
                    'Knowledge-distilled from Gemini frontier models to achieve elite competitive STEM and reasoning scores.',
                    'Optimized native execution on NVIDIA GPUs via TensorRT-LLM and Google TPU v5e.',
                    'Superior math and coding synthesis exceeding Llama 3 70B on several benchmarks.'
                ),
                'benchmarks' => array(
                    'MMLU' => '75.2% accuracy',
                    'Chatbot Arena (LMSYS)' => '1186 Elo score',
                    'HumanEval' => '73.8% pass@1',
                    'GSM8K' => '83.2% math reasoning'
                ),
                'googleSynergy' => 'First-class deployment in Vertex AI Model Garden and Google Colab with one-click TPU acceleration.',
                'samplePrompt' => 'Explain the mathematical intuition behind logit soft-capping in deep transformer training and implement it in PyTorch.',
                'sampleOutput' => '[Mathematical formulation with stability proofs and clean PyTorch forward pass implementation]'
            ),
            array(
                'id' => 'google/gemini-2-0-flash-lite',
                'name' => 'Gemini 2.0 Flash-Lite',
                'slug' => 'gemini-2-0-flash-lite',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'fastest',
                'categoryName' => 'Fastest Models',
                'throughput' => '240 tok/s',
                'ttft' => '130ms',
                'providersCount' => 24,
                'contextWindow' => '1M tokens',
                'inputPrice' => '$0.075 / 1M',
                'outputPrice' => '$0.30 / 1M',
                'tagline' => 'Google ultra-efficient, cost-optimized multimodal model engineered for high-throughput enterprise pipelines.',
                'summary' => 'Gemini 2.0 Flash-Lite represents the pinnacle of cost efficiency in frontier AI. Delivering sub-150ms time-to-first-token with full 1 million token multimodal context, it provides enterprise teams with unprecedented scale for high-volume text analysis, real-time transcription, and automated support categorization.',
                'architecture' => 'Optimized sparse MoE multimodal transformer distilled from Gemini 2.0 Flash, tuned for maximum TPU cluster throughput.',
                'keyCapabilities' => array(
                    'Ultra-low cost structure ($0.075/1M tokens) enabling continuous ambient AI processing.',
                    '1,000,000 token context window handling documents, spreadsheets, and video clips.',
                    'Exceptional latency with median output speed exceeding 240 tokens per second.',
                    'Native multimodal audio and visual comprehension.'
                ),
                'benchmarks' => array(
                    'MMLU' => '84.1% accuracy',
                    'Latency (TTFT)' => '130ms median',
                    'Output Speed' => '240 tok/s',
                    'Cost Savings' => '70% vs standard Flash'
                ),
                'googleSynergy' => 'Native Vertex AI endpoint with automatic autoscaling to 10,000 requests per second with zero provisioned overhead.',
                'samplePrompt' => 'Analyze this 500-page regulatory filing and extract all mentions of undisclosed material litigation risks into JSON format.',
                'sampleOutput' => '{"litigation_risks": [...], "confidence_scores": [...], "regulatory_sections": [...]}'
            ),
            array(
                'id' => 'google/imagen-3',
                'name' => 'Imagen 3',
                'slug' => 'imagen-3',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '3.5 sec/img',
                'ttft' => '400ms',
                'providersCount' => 15,
                'contextWindow' => 'Text-to-Image',
                'inputPrice' => '$0.03 / img',
                'outputPrice' => '$0.03 / img',
                'tagline' => 'Google highest-quality text-to-image foundation model with unmatched prompt fidelity and typography rendering.',
                'summary' => 'Imagen 3 is Google DeepMind state-of-the-art visual generation model. Engineered with deep cross-modal alignment, it produces stunning photorealism, captures intricate lighting and textures, and excels at rendering clean, legible text and typography directly within generated images.',
                'architecture' => 'Multimodal diffusion transformer conditioned on Gemini text embeddings with integrated SynthID digital watermarking.',
                'keyCapabilities' => array(
                    'Unrivaled typography generation: accurately spells words, signage, and logos on products and posters.',
                    'Hyper-realistic physical lighting, skin textures, subsurface scattering, and cinematic camera optics.',
                    'Rich stylistic versatility from hyperreal macro photography to watercolor, vector art, and claymation.',
                    'SynthID imperceptible cryptographic watermark embedded directly into pixel patterns.'
                ),
                'benchmarks' => array(
                    'Human Preference vs Midjourney' => '64% preference rate',
                    'Text Typography Accuracy' => '91.4% correct letter rendering',
                    'Prompt Alignment Score' => '9.2 / 10 benchmark rating',
                    'Artifact Reduction' => '85% fewer hand/finger deformities'
                ),
                'googleSynergy' => 'Powering ImageFX in Google Labs and available via Vertex AI Imagen API with enterprise indemnification.',
                'samplePrompt' => 'Macro studio photography of an espresso cup with latte art spelling "Google AI" in crisp foam, cinematic rim lighting, 85mm f/1.4 lens.',
                'sampleOutput' => '[Flawless 2048x2048 photorealistic rendering with perfect foam lettering and photographic depth of field]'
            ),
            array(
                'id' => 'google/lyria',
                'name' => 'Google DeepMind Lyria',
                'slug' => 'google-lyria',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'speech',
                'categoryName' => 'Speech & Audio',
                'throughput' => 'Real-time',
                'ttft' => '180ms',
                'providersCount' => 10,
                'contextWindow' => 'Audio Synthesis',
                'inputPrice' => '$0.02 / min',
                'outputPrice' => '$0.02 / min',
                'tagline' => 'DeepMind frontier music foundation model capable of generating high-fidelity instrumentals and vocals.',
                'summary' => 'Lyria is Google DeepMind groundbreaking music generation foundation model. It creates high-fidelity audio with intricate musical structures, multi-instrumental harmonies, and expressive vocal synthesis across diverse genres, powering Google Labs MusicFX and YouTube Dream Track.',
                'architecture' => 'Hierarchical neural audio diffusion model with continuous acoustic representations and SynthID Audio watermarking.',
                'keyCapabilities' => array(
                    'Full instrumental arrangement: drums, bass, brass, guitars, and orchestral strings with authentic acoustics.',
                    'Seamless genre fusion and real-time tempo, key, and mood modulations.',
                    'SynthID Audio: undetectable digital watermark resilient to audio compression and equalization.',
                    'Interactive prompt-looping and DJ-style stem separation.'
                ),
                'benchmarks' => array(
                    'Acoustic Fidelity' => '48kHz / 24-bit studio quality',
                    'Harmonic Coherence' => '94% musical consistency over 3 minutes',
                    'SynthID Resilience' => '99.8% detection after MP3 compression'
                ),
                'googleSynergy' => 'Integrated into YouTube Creator Studio and Google Labs experimental audio environments.',
                'samplePrompt' => 'An uplifting 1970s funk groove with slapped electric bass, brass stabs, warm Rhodes piano, and vintage vinyl warmth at 112 BPM.',
                'sampleOutput' => '[Rich stereo 48kHz audio stream with dynamic funk rhythm section and expressive brass accents]'
            ),
            array(
                'id' => 'google/alphafold-3',
                'name' => 'AlphaFold 3',
                'slug' => 'alphafold-3',
                'provider' => 'Google',
                'providerSlug' => 'google',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => 'Batch Compute',
                'ttft' => 'N/A (Scientific)',
                'providersCount' => 8,
                'contextWindow' => 'Biomolecular Sequence',
                'inputPrice' => 'Open Scientific Access',
                'outputPrice' => 'Open Scientific Access',
                'tagline' => 'Nobel Prize-winning foundation model predicting 3D structures and interactions of all life molecules.',
                'summary' => 'AlphaFold 3 by Google DeepMind and Isomorphic Labs is a revolutionary biological foundation model. Going beyond proteins, it predicts the structure and interactions of proteins, DNA, RNA, ligands, and chemical modifications with atomistic precision, transforming rational drug discovery.',
                'architecture' => 'Pairformer architecture combined with a 3D atomistic diffusion module operating directly on raw coordinates.',
                'keyCapabilities' => array(
                    'Universal biomolecular prediction: models proteins, nucleic acids (DNA/RNA), small molecule drugs, and ions.',
                    'Double the accuracy of previous physics-based molecular docking tools on antibody-antigen complexes.',
                    'Direct diffusion over atomic coordinates eliminating structural discretization errors.',
                    'Accelerates therapeutic candidate screening from years to minutes.'
                ),
                'benchmarks' => array(
                    'Protein-Ligand Accuracy' => '76% on PoseBusters benchmark (50% higher than traditional docking)',
                    'Protein-Nucleic Acid Binding' => '65% atomic interaction precision',
                    'Nobel Recognition' => 'Awarded 2024 Nobel Prize in Chemistry'
                ),
                'googleSynergy' => 'Powered by Google Cloud TPU v5e clusters and available globally through AlphaFold Server for non-commercial research.',
                'samplePrompt' => 'Fold the SARS-CoV-2 spike glycoprotein in complex with human ACE2 receptor and small-molecule inhibitor ligand.',
                'sampleOutput' => '[Complete 3D PDB/CIF coordinate file with per-atom confidence scores (pLDDT) and Predicted Aligned Error (PAE) matrices]'
            ),
            array(
                'id' => 'openai/gpt-5',
                'name' => 'GPT-5 Frontier Architecture',
                'slug' => 'gpt-5',
                'provider' => 'OpenAI',
                'providerSlug' => 'openai',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '110 tok/s',
                'ttft' => '320ms',
                'providersCount' => 32,
                'contextWindow' => '500k tokens',
                'inputPrice' => '$5.00 / 1M',
                'outputPrice' => '$20.00 / 1M',
                'tagline' => 'OpenAI next-generation flagship foundation model unifying deep reasoning, multimodal agency, and world knowledge.',
                'summary' => 'GPT-5 (codenamed Orion) represents OpenAI next leap in foundation model capabilities. Combining architectural innovations from the o-series reasoning models with native multimodal pre-training, GPT-5 delivers doctoral-level expertise across law, medicine, software systems, and scientific discovery.',
                'architecture' => 'Sparse Mixture-of-Experts with dynamic reasoning token allocation and multimodal cross-attention layers.',
                'keyCapabilities' => array(
                    'PhD-level synthesis across biology, quantum physics, corporate law, and systems programming.',
                    'Autonomous long-horizon computer use and asynchronous agent orchestration.',
                    'Drastically reduced hallucination rates with built-in factual verification passes.',
                    'Multimodal understanding encompassing text, high-res vision, audio, and code ASTs.'
                ),
                'benchmarks' => array(
                    'MMLU-Pro' => '93.5% accuracy',
                    'SWE-bench Verified' => '72.4% resolved issues',
                    'GPQA Diamond' => '82.0% PhD science benchmark',
                    'MATH-500' => '96.2% mathematical accuracy'
                ),
                'googleSynergy' => 'Routinely benchmarked against Gemini 2.5 Pro; accessible via multi-cloud enterprise proxies.',
                'samplePrompt' => 'Design an asynchronous multi-region consensus protocol for distributed ledgers resilient to 33% Byzantine network partitions.',
                'sampleOutput' => '[Complete architectural formal specification, TLA+ safety proofs, and Rust actor implementation]'
            ),
            array(
                'id' => 'openai/codex',
                'name' => 'OpenAI Codex (Legacy API)',
                'slug' => 'openai-codex',
                'provider' => 'OpenAI',
                'providerSlug' => 'openai',
                'category' => 'coding',
                'categoryName' => 'Coding & Software Dev',
                'throughput' => 'Sunset API',
                'ttft' => 'Sunset',
                'providersCount' => 0,
                'contextWindow' => '8k (Historical)',
                'inputPrice' => 'Discontinued',
                'outputPrice' => 'Discontinued',
                'status' => 'discontinued',
                'statusNotice' => 'OpenAI officially sunset the standalone Codex API in March 2023. Code generation capabilities have been deeply integrated and vastly superseded by GPT-4o, OpenAI o3-mini, and GitHub Copilot.',
                'tagline' => 'Historic code generation model that powered early GitHub Copilot, now officially sunset and superseded by GPT-4o.',
                'summary' => 'OpenAI Codex was the foundational language-to-code model fine-tuned from GPT-3 on billions of lines of public GitHub source code. It pioneered automated autocomplete and natural-language programming. OpenAI officially sunset the standalone Codex API in March 2023 in favor of modern chat-based reasoning models like GPT-4o and o3-mini.',
                'architecture' => '12B parameter autoregressive transformer fine-tuned on 159GB of public code repositories.',
                'keyCapabilities' => array(
                    'Pioneered natural language to Python, JavaScript, and SQL generation.',
                    'Served as the original backend engine powering the initial launch of GitHub Copilot.',
                    'Established the HumanEval benchmark that is still used to measure coding models today.',
                    'Historical milestone in the history of generative AI software development.'
                ),
                'benchmarks' => array(
                    'HumanEval (pass@1)' => '28.8% (2021 historical baseline)',
                    'Status' => 'Discontinued / Retired March 2023',
                    'Modern Successor' => 'GPT-4o & OpenAI o3-mini'
                ),
                'googleSynergy' => 'Modern developers migrate legacy Codex workflows to Gemini 2.5 Pro and Gemini Code Assist.',
                'samplePrompt' => 'Write a Python function to check whether a string has balanced parentheses using a stack.',
                'sampleOutput' => '[Legacy Codex Python code output with stack data structure]'
            ),
            array(
                'id' => 'openai/dall-e-3',
                'name' => 'DALLÂ·E 3',
                'slug' => 'dall-e-3',
                'provider' => 'OpenAI',
                'providerSlug' => 'openai',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '6 sec/img',
                'ttft' => '500ms',
                'providersCount' => 20,
                'contextWindow' => 'Text-to-Image',
                'inputPrice' => '$0.040 / img',
                'outputPrice' => '$0.040 / img',
                'tagline' => 'OpenAI flagship text-to-image foundation model natively integrated with ChatGPT prompt expansion.',
                'summary' => 'DALLÂ·E 3 translates nuanced text requests into extremely detailed images without requiring prompt-engineering hacks. Built natively on top of ChatGPT, it refines complex prompts into descriptive captions that guide diffusion synthesis, delivering rich scene composition and legible text elements.',
                'architecture' => 'Diffusion model conditioned on synthetic captions generated by multimodal GPT-4 vision encoders.',
                'keyCapabilities' => array(
                    'Deep adherence to complex, paragraph-long descriptions without omitting elements.',
                    'In-image text rendering for signage, badges, book covers, and stickers.',
                    'Built-in safety mitigations preventing generation of public figures and hateful content.',
                    'Native conversational inpainting and editing directly within ChatGPT.'
                ),
                'benchmarks' => array(
                    'Prompt Adherence' => '8.9 / 10 benchmark rating',
                    'Text Accuracy' => '82% on standard typography tests',
                    'Status Note' => 'DALL-E 2 discontinued; DALL-E 3 is active frontier model'
                ),
                'googleSynergy' => 'Frequently compared against Google Imagen 3 on photorealism and typographic fidelity.',
                'samplePrompt' => 'An oil painting of an astronomer sitting on a crescent moon reading a glowing holographic book titled "Deep Cosmos".',
                'sampleOutput' => '[1024x1024 oil painting rendering with rich brush strokes and glowing book typography]'
            ),
            array(
                'id' => 'anthropic/claude-fable-5-2',
                'name' => 'Claude Fable 5.2',
                'slug' => 'claude-fable-5-2',
                'provider' => 'Anthropic',
                'providerSlug' => 'anthropic',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '105 tok/s',
                'ttft' => '290ms',
                'providersCount' => 12,
                'contextWindow' => '500k tokens',
                'inputPrice' => '$4.00 / 1M',
                'outputPrice' => '$16.00 / 1M',
                'tagline' => 'Anthropic frontier narrative, creative synthesis, and multi-step cognitive architecture model.',
                'summary' => 'Claude Fable 5.2 is designed specifically for deep creative writing, sophisticated brand voice modeling, and multi-layered narrative design. It avoids AI cliches, possesses an unmatched command of literary prose, and maintains intricate continuity across half-million-token contexts.',
                'architecture' => 'Constitutional AI transformer with specialized narrative long-term memory attention heads.',
                'keyCapabilities' => array(
                    'Natural literary voice devoid of predictable formulaic AI cadences.',
                    'Flawless narrative consistency across 100,000-word manuscripts.',
                    'Nuanced character dialogue with distinct psychological personalities.',
                    'Deep stylistic mimicry of complex historical or academic prose.'
                ),
                'benchmarks' => array(
                    'Human Evaluation (Prose Quality)' => '94.2% preference over standard LLMs',
                    'Context Consistency' => '99.5% character detail retention across 500k tokens'
                ),
                'googleSynergy' => 'Available through Google Cloud Vertex AI Model Garden with VPC Service Controls.',
                'samplePrompt' => 'Write the opening chapter of a noir detective novel set in 2045 Neo-Tokyo where memory theft is an art form.',
                'sampleOutput' => '[Atmospheric, cinematic prose opening with rain-slicked asphalt and hardboiled internal monologue]'
            ),
            array(
                'id' => 'anthropic/claude-mythos-5-2',
                'name' => 'Claude Mythos 5.2',
                'slug' => 'claude-mythos-5-2',
                'provider' => 'Anthropic',
                'providerSlug' => 'anthropic',
                'category' => 'reasoning',
                'categoryName' => 'Reasoning & Agentic',
                'throughput' => '85 tok/s',
                'ttft' => '350ms',
                'providersCount' => 14,
                'contextWindow' => '300k tokens',
                'inputPrice' => '$6.00 / 1M',
                'outputPrice' => '$24.00 / 1M',
                'tagline' => 'Anthropic frontier symbolic theorem proving, formal verification, and deep mathematical reasoning model.',
                'summary' => 'Claude Mythos 5.2 is Anthropic pinnacle model for mathematical proofs, formal systems verification, and deep deductive logic. Trained with advanced test-time compute scaling and interactive formal verification environments like Lean 4 and Coq, it solves problems that stump traditional LLMs.',
                'architecture' => 'Hybrid reasoning transformer with reinforcement learning from formal theorem proof environments.',
                'keyCapabilities' => array(
                    'Native Lean 4 and Coq theorem proving with zero syntax errors.',
                    'Formal verification of critical cryptographic protocols and smart contracts.',
                    'Extended chain-of-thought deliberate thinking with transparent error backtracking.',
                    'Complex multi-variable optimization and algebraic topology.'
                ),
                'benchmarks' => array(
                    'MATH-500' => '95.8% accuracy',
                    'AIME 2024' => '84.6% high school math olympiad',
                    'Formal Proof Pass Rate' => '72.3% automated formalization'
                ),
                'googleSynergy' => 'Deploys on Vertex AI alongside BigQuery and Looker for enterprise quantitative auditing.',
                'samplePrompt' => 'Formalize and prove that every finite field has prime power order in Lean 4.',
                'sampleOutput' => '[Complete syntactically verified Lean 4 code proof with lemma definitions]'
            ),
            array(
                'id' => 'anthropic/claude-opus-5-5',
                'name' => 'Claude Opus 5.5',
                'slug' => 'claude-opus-5-5',
                'provider' => 'Anthropic',
                'providerSlug' => 'anthropic',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '80 tok/s',
                'ttft' => '380ms',
                'providersCount' => 26,
                'contextWindow' => '500k tokens',
                'inputPrice' => '$15.00 / 1M',
                'outputPrice' => '$75.00 / 1M',
                'tagline' => 'Anthropic most intelligent frontier flagship for mission-critical enterprise analysis and complex autonomy.',
                'summary' => 'Claude Opus 5.5 represents the absolute ceiling of Anthropic intelligence. Engineered for tasks where failure is not an optionâ€”such as regulatory compliance, high-stakes financial modeling, and architectural auditsâ€”Opus 5.5 demonstrates profound reasoning and nuanced understanding.',
                'architecture' => 'Ultra-dense transformer scaled across massive TPU/GPU clusters with Constitutional RLHF.',
                'keyCapabilities' => array(
                    'Doctoral-level expertise across law, finance, biochemistry, and geopolitical analysis.',
                    'Exhaustive 500k token context window with 99.8% needle-in-a-haystack recall.',
                    'Extreme resistance to jailbreaks, prompt injections, and adversarial persuasion.',
                    'Enterprise document synthesis that reconciles thousands of conflicting regulatory guidelines.'
                ),
                'benchmarks' => array(
                    'MMLU-Pro' => '92.8% benchmark score',
                    'GPQA Diamond' => '83.4% PhD scientific problem solving',
                    'Hallucination Rate' => '<0.8% verified facts'
                ),
                'googleSynergy' => 'Available on Google Cloud Vertex AI with full HIPAA, SOC 2, and FedRAMP compliance guarantees.',
                'samplePrompt' => 'Audit this 1,200-page cross-border merger agreement against EU anti-trust and CFIUS national security regulations.',
                'sampleOutput' => '[Comprehensive 12-section compliance brief with risk mitigation clauses and regulatory precedents]'
            ),
            array(
                'id' => 'microsoft/phi-4',
                'name' => 'Microsoft Phi-4 14B',
                'slug' => 'phi-4',
                'provider' => 'Microsoft',
                'providerSlug' => 'microsoft',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '130 tok/s',
                'ttft' => '190ms',
                'providersCount' => 18,
                'contextWindow' => '16k tokens',
                'inputPrice' => '$0.20 / 1M',
                'outputPrice' => '$0.20 / 1M',
                'tagline' => 'Microsoft 14B small language model delivering frontier-level mathematical reasoning and code intelligence.',
                'summary' => 'Phi-4 is Microsoft Research state-of-the-art 14-billion parameter open-weights model. Trained using synthetic "textbooks are all you need" data and organic high-quality STEM curricula, Phi-4 matches or exceeds 70B parameter models on mathematics, code, and logical reasoning benchmarks.',
                'architecture' => '14B parameter dense autoregressive transformer optimized for ONNX Runtime and local device execution.',
                'keyCapabilities' => array(
                    'Remarkable mathematical reasoning beating GPT-4 on standard MATH benchmarks.',
                    'Compact 14B size runs on high-end laptops or single cloud GPUs (e.g. NVIDIA L4).',
                    'Permissive MIT open-source license for commercial innovation.',
                    'High token throughput with low compute and energy footprint.'
                ),
                'benchmarks' => array(
                    'MATH' => '84.8% accuracy',
                    'MMLU' => '84.6% accuracy',
                    'HumanEval' => '81.4% pass@1',
                    'GSM8K' => '90.2% grade school math'
                ),
                'googleSynergy' => 'Easily self-hosted on Google Cloud Compute Engine G2 instances or Cloud Run with Ollama.',
                'samplePrompt' => 'Find all integer solutions to the equation x^3 + y^3 = z^3 + w^3 with x,y,z,w < 50.',
                'sampleOutput' => '[Detailed number theory breakdown of Ramanujan taxicab numbers with complete integer coordinate sets]'
            ),
            array(
                'id' => 'meta/sam-2',
                'name' => 'Segment Anything 2 (SAM 2)',
                'slug' => 'sam-2',
                'provider' => 'Meta',
                'providerSlug' => 'meta',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '45 fps (Video)',
                'ttft' => '50ms',
                'providersCount' => 12,
                'contextWindow' => 'Visual Segmentation',
                'inputPrice' => 'Open Source',
                'outputPrice' => 'Open Source',
                'tagline' => 'Meta frontier foundation model for real-time visual promptable object segmentation across images and videos.',
                'summary' => 'SAM 2 (Segment Anything Model 2) extends foundation segmentation to the temporal video domain. With a memory-attention architecture, it tracks and segments any object in a video stream in real time from a single click or bounding box prompt, revolutionizing video editing and robotics.',
                'architecture' => 'Streaming video foundation transformer with memory encoder, memory bank, and mask decoder modules.',
                'keyCapabilities' => array(
                    'Promptable zero-shot segmentation of any object across thousands of continuous video frames.',
                    'Real-time streaming inference running at 45 frames per second on a single GPU.',
                    'Handles severe occlusions, viewpoint changes, and disappearing/reappearing objects.',
                    'Permissive Apache 2.0 open-source release by Meta FAIR.'
                ),
                'benchmarks' => array(
                    'Video Object Segmentation (J&F)' => '76.8% accuracy (World Frontier Record)',
                    'Interactive Speed' => '44.8 FPS real-time tracking',
                    'Human Annotation Time' => '8.4x faster dataset labeling'
                ),
                'googleSynergy' => 'Deployable on Google Cloud Vertex AI Model Garden with GPU acceleration.',
                'samplePrompt' => 'Track the surgical scalpel throughout this 20-minute laparoscopy video and extract clean binary alpha masks.',
                'sampleOutput' => '[Continuous per-frame binary mask tensor stream with occlusion flags and tracking confidence]'
            ),
            array(
                'id' => 'meta/movie-gen',
                'name' => 'Meta Movie Gen',
                'slug' => 'movie-gen',
                'provider' => 'Meta',
                'providerSlug' => 'meta',
                'category' => 'video',
                'categoryName' => 'Video Generation',
                'throughput' => '1080p 16-sec',
                'ttft' => '2.5 sec',
                'providersCount' => 8,
                'contextWindow' => 'Video & Audio Diffusion',
                'inputPrice' => 'Research Access',
                'outputPrice' => 'Research Access',
                'tagline' => 'Meta 30B parameter generative video model producing 1080p HD cinema with synchronized Foley audio.',
                'summary' => 'Meta Movie Gen is a cast of state-of-the-art foundation models that generate 1080p high-definition video with realistic physical motion, camera control, and synchronized cinematic audio (sound effects, Foley, ambient background music) aligned to video actions.',
                'architecture' => '30B parameter video transformer combined with a 13B parameter audio generation model and Flow Matching.',
                'keyCapabilities' => array(
                    'High definition 1080p video generation at 16 frames per second with cinematic camera paths.',
                    'Synchronized audio generation: synthesizes footsteps, wind, engine roars, and music matching on-screen motion.',
                    'Personalized video generation: takes a portrait photo of a person and animates them into custom scenes.',
                    'Precise video editing: modifies specific objects, backgrounds, or lighting while preserving scene identity.'
                ),
                'benchmarks' => array(
                    'Human Preference vs Runway Gen-3' => '58% preference rate',
                    'Visual Quality Score' => '4.35 / 5 MOS',
                    'Audio-Visual Alignment' => '92% accurate Foley sync'
                ),
                'googleSynergy' => 'Competes directly with Google Veo and OpenAI Sora in the generative video arena.',
                'samplePrompt' => 'A cheetah sprinting across the golden savannah in slow motion, dust kicking up behind paws, sunset lighting, synchronized acoustic breathing and wind Foley.',
                'sampleOutput' => '[Cinematic 1080p 16-second MP4 with 48kHz spatial audio of sprinting cheetah and environmental breeze]'
            ),
            array(
                'id' => 'meta/code-llama',
                'name' => 'Meta Code Llama (Legacy)',
                'slug' => 'code-llama',
                'provider' => 'Meta',
                'providerSlug' => 'meta',
                'category' => 'coding',
                'categoryName' => 'Coding & Software Dev',
                'throughput' => 'Superseded',
                'ttft' => 'Superseded',
                'providersCount' => 0,
                'contextWindow' => '100k (Historical)',
                'inputPrice' => 'Open Source',
                'outputPrice' => 'Open Source',
                'status' => 'discontinued',
                'statusNotice' => 'Meta has officially superseded the dedicated Code Llama family with Llama 3, 3.1, and 3.3. These newer general models natively outperform Code Llama across all programming languages, debugging, and systems engineering.',
                'tagline' => 'Historic open-weights code model by Meta, now superseded by modern Llama 3.1 and 3.3 architectures.',
                'summary' => 'Code Llama was Meta specialized open-weights code model family released in 2023. Fine-tuned from Llama 2 on code-specific datasets, it supported infilling, large context windows, and Python specialization. Meta has since superseded Code Llama with the unified Llama 3 and 3.3 series, which natively achieve vastly superior coding benchmark scores.',
                'architecture' => '7B, 13B, 34B, and 70B parameter decoder-only transformer with fill-in-the-middle (FIM) training.',
                'keyCapabilities' => array(
                    'First major open-weights code model with 100k context window.',
                    'Fill-In-The-Middle (FIM) support for IDE code completion.',
                    'Code Llama - Python and Code Llama - Instruct specialized variants.',
                    'Historic milestone that catalyzed open-source AI developer tooling.'
                ),
                'benchmarks' => array(
                    'HumanEval (70B)' => '67.8% pass@1 (2023 baseline)',
                    'Modern Replacement' => 'Llama 3.3 70B (82.6% pass@1)',
                    'Status' => 'Superseded / Retired'
                ),
                'googleSynergy' => 'Modern developers deploy Llama 3.3 70B on Google Cloud Vertex AI rather than legacy Code Llama.',
                'samplePrompt' => 'Write a C++ implementation of a lock-free ring buffer queue.',
                'sampleOutput' => '[Legacy Code Llama C++ code output]'
            ),
            array(
                'id' => 'nvidia/nemotron-4-340b',
                'name' => 'NVIDIA Nemotron-4 340B',
                'slug' => 'nemotron-4-340b',
                'provider' => 'NVIDIA',
                'providerSlug' => 'nvidia',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '65 tok/s',
                'ttft' => '310ms',
                'providersCount' => 16,
                'contextWindow' => '4k tokens',
                'inputPrice' => '$2.50 / 1M',
                'outputPrice' => '$5.00 / 1M',
                'tagline' => 'NVIDIA open synthetic data generation and reasoning powerhouse for building enterprise models.',
                'summary' => 'Nemotron-4 340B is NVIDIA open-access foundation model specifically engineered to generate synthetic data for training and fine-tuning smaller specialized models. It features high precision in mathematics, coding, and role-playing, empowering enterprises to create sovereign AI pipelines.',
                'architecture' => '340B parameter dense autoregressive transformer optimized with NVIDIA Megatron-LM and TensorRT-LLM.',
                'keyCapabilities' => array(
                    'World-class synthetic data generator producing high-quality training dialogues, code, and reasoning steps.',
                    'Nemotron-4 340B Reward model provides automated quality scoring and RLHF feedback loops.',
                    'Permissive NVIDIA Open Model License for commercial building and data synthesis.',
                    'Turnkey deployment with NVIDIA NIM microservices on GPU clusters.'
                ),
                'benchmarks' => array(
                    'MMLU' => '81.1% accuracy',
                    'RewardBench' => '92.0% alignment scoring',
                    'HumanEval' => '73.2% pass@1'
                ),
                'googleSynergy' => 'Deploys on Google Cloud A3 GPU instances powered by NVIDIA H100 SXM5 GPUs.',
                'samplePrompt' => 'Generate 5 synthetic multi-turn conversations teaching a robotics student inverse kinematics with mathematical derivations.',
                'sampleOutput' => '[Structured synthetic training dataset with student inquiries, expert mathematical derivations, and verification checks]'
            ),
            array(
                'id' => 'nvidia/cosmos',
                'name' => 'NVIDIA Cosmos World Foundation Model',
                'slug' => 'nvidia-cosmos',
                'provider' => 'NVIDIA',
                'providerSlug' => 'nvidia',
                'category' => 'video',
                'categoryName' => 'Video Generation',
                'throughput' => 'Physical Simulation',
                'ttft' => '200ms',
                'providersCount' => 10,
                'contextWindow' => 'Spatio-Temporal Physics',
                'inputPrice' => 'Enterprise API',
                'outputPrice' => 'Enterprise API',
                'tagline' => 'NVIDIA world foundation model platform simulating physical dynamics for robotics and autonomous vehicles.',
                'summary' => 'NVIDIA Cosmos is a family of state-of-the-art world foundation models designed for Physical AI. Rather than generating mere cinematic entertainment, Cosmos understands physical mechanics, gravity, friction, and spatial consistency to simulate real-world physical dynamics for humanoid robots and self-driving fleets.',
                'architecture' => 'Autoregressive and diffusion world models with high-compression spatial-temporal tokenizers.',
                'keyCapabilities' => array(
                    'Simulates realistic physical trajectories, object collisions, fluid flows, and lighting.',
                    'Generates infinite synthetic sensor data (LiDAR, RGB, depth) for training autonomous machines.',
                    'Accelerates embodied robot learning by orders of magnitude through physics-grounded simulation.',
                    'Powers the NVIDIA Omniverse and Isaac simulation environments.'
                ),
                'benchmarks' => array(
                    'Physical Coherence' => '94% collision physics fidelity',
                    'Video Tokenizer Compression' => '8x spatial, 8x temporal lossless tokenization'
                ),
                'googleSynergy' => 'Integrates with Google Cloud TPU and GPU clusters for massive-scale synthetic data training.',
                'samplePrompt' => 'Simulate a humanoid robot navigating a cluttered warehouse, avoiding a tipped pallet while maintaining balance.',
                'sampleOutput' => '[Physics-consistent multi-camera video feed with ground-truth depth maps and spatial trajectory vectors]'
            ),
            array(
                'id' => 'nvidia/gr00t',
                'name' => 'NVIDIA Project GR00T',
                'slug' => 'project-gr00t',
                'provider' => 'NVIDIA',
                'providerSlug' => 'nvidia',
                'category' => 'reasoning',
                'categoryName' => 'Reasoning & Agentic',
                'throughput' => 'Real-Time Control',
                'ttft' => '30ms',
                'providersCount' => 8,
                'contextWindow' => 'Multimodal Motor Actions',
                'inputPrice' => 'Developer Program',
                'outputPrice' => 'Developer Program',
                'tagline' => 'NVIDIA general-purpose foundation model for humanoid robot reasoning, vision, and motor dexterity.',
                'summary' => 'Project GR00T (Generalist Robot 00 Technology) is NVIDIA groundbreaking foundation model for humanoid robots. Powered by multimodal perception, GR00T takes natural language prompts and visual observations to orchestrate complex physical motor control, walking, manipulation, and tool use.',
                'architecture' => 'Multimodal foundation model taking text, speech, and video to output robot joint angles and motor trajectories.',
                'keyCapabilities' => array(
                    'Zero-shot physical dexterity: imitates human actions from video demonstrations.',
                    'Understands natural language commands in human environments and translates them to coordinated arm and leg movements.',
                    'Trained in NVIDIA Isaac Sim across millions of simulated hours before real-world transfer.',
                    'Compatible with leading humanoid hardware from Figure, 1X, Boston Dynamics, and Agility.'
                ),
                'benchmarks' => array(
                    'Sim-to-Real Transfer' => '88% direct task success without manual calibration',
                    'Control Loop Frequency' => '50Hz real-time motor response'
                ),
                'googleSynergy' => 'Complementary to Google DeepMind RT-2 and Gemini robotics research.',
                'samplePrompt' => 'Pick up the fragile glassware from the table and place it safely in the dishwasher.',
                'sampleOutput' => '[Multi-joint trajectory sequence: wrist rotation, grip pressure modulation, and collision-free arm path]'
            ),
            array(
                'id' => 'xai/aurora',
                'name' => 'xAI Aurora',
                'slug' => 'xai-aurora',
                'provider' => 'xAI',
                'providerSlug' => 'x-ai',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => '120 tok/s',
                'ttft' => '210ms',
                'providersCount' => 14,
                'contextWindow' => '256k tokens',
                'inputPrice' => '$2.00 / 1M',
                'outputPrice' => '$10.00 / 1M',
                'tagline' => 'xAI frontier multimodal visual reasoning and scientific discovery foundation model.',
                'summary' => 'Aurora is xAI advanced multimodal reasoning model designed for high-resolution visual comprehension, complex chart parsing, and scientific discovery. Trained on the massive Colossus 100k H100 cluster in Memphis, Aurora delivers cutting-edge visual reasoning and code synthesis.',
                'architecture' => 'Large-scale multimodal transformer with native high-resolution vision encoder and real-time knowledge grounding.',
                'keyCapabilities' => array(
                    'Flawless parsing of complex schematics, architectural blueprints, and financial charts.',
                    'Real-time grounding via the xAI live data pipeline and real-world event analysis.',
                    'Uncensored, objective scientific inquiry and mathematical derivation.',
                    'High output token speed optimized on the xAI Colossus supercomputer.'
                ),
                'benchmarks' => array(
                    'ChartQA' => '88.4% benchmark accuracy',
                    'MathVista' => '71.2% visual mathematical reasoning',
                    'MMMU' => '68.5% college-level multimodal benchmark'
                ),
                'googleSynergy' => 'Frequently benchmarked against Gemini 2.5 Flash and Pro on multimodal vision tasks.',
                'samplePrompt' => 'Analyze this multi-layer PCB circuit diagram, identify all voltage regulator stages, and calculate thermal dissipation.',
                'sampleOutput' => '[Component-by-component electrical analysis with thermal dissipation formulas and layout recommendations]'
            ),
            array(
                'id' => 'mistral/ministral-8b',
                'name' => 'Ministral 8B',
                'slug' => 'ministral-8b',
                'provider' => 'Mistral AI',
                'providerSlug' => 'mistral',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '160 tok/s',
                'ttft' => '140ms',
                'providersCount' => 22,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.10 / 1M',
                'outputPrice' => '$0.10 / 1M',
                'tagline' => 'Mistral AI state-of-the-art 8B edge model delivering flagship reasoning on laptops and local servers.',
                'summary' => 'Ministral 8B sets a new standard for sub-10B category models. Featuring an interleaved sliding-window attention mechanism and 128k context window, it delivers blazingly fast inference for on-device copilots, automated customer agents, and edge devices without cloud dependency.',
                'architecture' => '8.06B parameter dense transformer with interleaved sliding-window attention and Tekken tokenizer.',
                'keyCapabilities' => array(
                    'Runs locally on consumer laptops, Apple Silicon MacBooks, and edge server boxes.',
                    '128,000 token context window handling entire PDF books and multi-file codebases.',
                    'Native multi-lingual capabilities covering English, French, German, Spanish, and Italian.',
                    'Advanced function calling and structured JSON schema enforcement.'
                ),
                'benchmarks' => array(
                    'MMLU' => '73.5% accuracy',
                    'HumanEval' => '72.0% pass@1',
                    'GSM8K' => '84.2% math reasoning'
                ),
                'googleSynergy' => 'Available on Google Cloud Vertex AI and easily containerized on Cloud Run for low-cost microservices.',
                'samplePrompt' => 'Extract all invoice line items, tax IDs, and payment terms from this OCR scan into strict JSON.',
                'sampleOutput' => '{"vendor": "Acme Corp", "tax_id": "FR12345678", "total": 1420.50, "items": [...]}'
            ),
            array(
                'id' => 'deepseek/janus-pro',
                'name' => 'DeepSeek Janus-Pro 7B',
                'slug' => 'janus-pro',
                'provider' => 'DeepSeek',
                'providerSlug' => 'deepseek',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '4 sec/img',
                'ttft' => '180ms',
                'providersCount' => 16,
                'contextWindow' => 'Unified Vision-Language',
                'inputPrice' => '$0.05 / 1M',
                'outputPrice' => '$0.10 / 1M',
                'tagline' => 'DeepSeek unified multimodal model excelling at both visual understanding and high-fidelity image generation.',
                'summary' => 'Janus-Pro by DeepSeek is an innovative open-source unified multimodal foundation model. Unlike conventional models that separate vision understanding from image generation, Janus-Pro decouples visual encoding to achieve state-of-the-art results in both multimodal reasoning and text-to-image synthesis.',
                'architecture' => 'Unified autoregressive transformer with decoupled visual encoding for understanding (SigLIP) and generation (VQ tokenizer).',
                'keyCapabilities' => array(
                    'Unified framework handling multimodal vision QA and text-to-image generation in a single model.',
                    'Decoupled visual encoders eliminate task conflict between understanding and pixel generation.',
                    'Open weights under permissive MIT license for private research and commercial hosting.',
                    'Exceptional instruction following for detailed artistic and photographic compositions.'
                ),
                'benchmarks' => array(
                    'GenEval' => '0.80 overall generation benchmark score',
                    'MMBench' => '79.2% visual question answering',
                    'POPE' => '89.4% object hallucination mitigation'
                ),
                'googleSynergy' => 'Easily self-hosted on Google Cloud Compute Engine G2 instances with NVIDIA L4 GPUs.',
                'samplePrompt' => 'An intricately detailed cyberpunk apothecary shop filled with glowing bioluminescent herbs in glass jars, volumetric neon lighting.',
                'sampleOutput' => '[Richly colored 1024x1024 image rendering with neon reflections and intricate glass detailing]'
            ),
            array(
                'id' => 'alibaba/wan-2-1',
                'name' => 'Alibaba Wan 2.1 Video',
                'slug' => 'wan-2-1',
                'provider' => 'Alibaba',
                'providerSlug' => 'qwen',
                'category' => 'video',
                'categoryName' => 'Video Generation',
                'throughput' => '1080p Video',
                'ttft' => '8 sec',
                'providersCount' => 12,
                'contextWindow' => 'Text/Image-to-Video',
                'inputPrice' => '$0.05 / video',
                'outputPrice' => '$0.05 / video',
                'tagline' => 'Alibaba open-weights video foundation model delivering cinematic motion and physical simulation.',
                'summary' => 'Wan 2.1 is Alibaba open generative video foundation model family (14B and 1.3B). Delivering 1080p high-definition text-to-video and image-to-video synthesis, Wan 2.1 rivals closed frontier models in cinematic aesthetics, complex physics simulation, and prompt alignment.',
                'architecture' => '3D Spatio-Temporal Diffusion Transformer (DiT) with custom Video VAE and flow matching.',
                'keyCapabilities' => array(
                    'High definition 1080p video generation with realistic human anatomy and fluid motion.',
                    'Open weights under Apache 2.0 license: deployable on local consumer GPUs (RTX 4090).',
                    'Supports text-to-video, image-to-video, and video inpainting extension.',
                    'Rich camera motion controls including pan, zoom, tilt, and orbital tracking.'
                ),
                'benchmarks' => array(
                    'VBench Total Score' => '84.5% overall quality',
                    'Motion Smoothness' => '96.2% temporal consistency',
                    'Human Preference' => 'Matches Runway Gen-3 on photorealism'
                ),
                'googleSynergy' => 'Easily deployed on Google Cloud Vertex AI custom containers for automated media pipelines.',
                'samplePrompt' => 'Cinematic tracking shot of an astronaut riding a holographic horse across a field of glass flowers on an alien planet, 4K resolution.',
                'sampleOutput' => '[Cinematic 1080p 5-second video rendering with smooth orbital camera movement and volumetric lighting]'
            ),
            array(
                'id' => 'amazon/amazon-titan',
                'name' => 'Amazon Titan (Legacy)',
                'slug' => 'amazon-titan',
                'provider' => 'Amazon',
                'providerSlug' => 'amazon',
                'category' => 'flagship',
                'categoryName' => 'Flagship & General AI',
                'throughput' => 'Superseded',
                'ttft' => 'Superseded',
                'providersCount' => 0,
                'contextWindow' => '32k (Historical)',
                'inputPrice' => 'Superseded',
                'outputPrice' => 'Superseded',
                'status' => 'discontinued',
                'statusNotice' => 'Amazon Web Services (AWS) has officially superseded the original Titan foundation models with the next-generation Amazon Nova series (Nova Pro, Nova Lite, Nova Micro, and Nova Reel), which deliver vastly superior intelligence, multimodality, and cost efficiency.',
                'tagline' => 'First-generation AWS foundation models, now officially superseded by the Amazon Nova model family.',
                'summary' => 'Amazon Titan was AWS original generation of proprietary foundation models, encompassing Titan Text, Titan Image Generator, and Titan Multimodal Embeddings on Amazon Bedrock. AWS has officially transitioned its frontier foundation strategy to the Amazon Nova family, which delivers order-of-magnitude improvements in reasoning, vision, and video generation.',
                'architecture' => 'First-generation proprietary dense transformer architecture trained on AWS Trainium clusters.',
                'keyCapabilities' => array(
                    'Pioneered foundation model availability natively inside Amazon Bedrock.',
                    'Enterprise data privacy with zero customer data retention for model re-training.',
                    'Integrated watermarking for generated images.',
                    'Historical baseline for Amazon enterprise cloud AI.'
                ),
                'benchmarks' => array(
                    'MMLU' => '65.2% (Historical baseline)',
                    'Modern Replacement' => 'Amazon Nova Pro & Nova Lite',
                    'Status' => 'Superseded / Retired'
                ),
                'googleSynergy' => 'Enterprises migrating off legacy Titan frequently evaluate Google Gemini 2.5 Pro on Vertex AI.',
                'samplePrompt' => 'Summarize this customer support transcript and list follow-up action items.',
                'sampleOutput' => '[Legacy Amazon Titan summary output]'
            ),
            array(
                'id' => 'ibm/granite-3-8b',
                'name' => 'IBM Granite 3.0 8B',
                'slug' => 'granite-3-8b',
                'provider' => 'IBM',
                'providerSlug' => 'ibm',
                'category' => 'value',
                'categoryName' => 'Value Leaders',
                'throughput' => '140 tok/s',
                'ttft' => '160ms',
                'providersCount' => 14,
                'contextWindow' => '128k tokens',
                'inputPrice' => '$0.15 / 1M',
                'outputPrice' => '$0.15 / 1M',
                'tagline' => 'IBM open-source enterprise foundation model optimized for business workflows, code, and RAG.',
                'summary' => 'IBM Granite 3.0 8B is a fully open-source, commercially safe enterprise language model released under the Apache 2.0 license. Trained on 12 trillion tokens with rigorous data governance and legal indemnification, Granite 3.0 delivers state-of-the-art enterprise task performance.',
                'architecture' => '8.2B parameter dense transformer trained with enterprise data filtering, safety alignment, and 128k context.',
                'keyCapabilities' => array(
                    'Permissive Apache 2.0 license with full IBM intellectual property indemnification.',
                    'Elite performance on enterprise Retrieval-Augmented Generation (RAG) and tool calling.',
                    'Small footprint runs on single enterprise GPUs or on-premises servers.',
                    'Trained on legal, financial, and business data with zero copyright ambiguity.'
                ),
                'benchmarks' => array(
                    'RAG Benchmark (RAGBench)' => '82.4% factual accuracy',
                    'MMLU' => '74.2% accuracy',
                    'Cybersecurity Safety' => '99.2% refusal of malicious exploits'
                ),
                'googleSynergy' => 'Can be deployed within Google Cloud Kubernetes Engine (GKE) for private enterprise inference.',
                'samplePrompt' => 'Parse this enterprise invoice XML schema, reconcile discrepancies against purchase orders, and generate SAP journal entries.',
                'sampleOutput' => '[Structured enterprise accounting reconciliation with audit trail and SAP RFC parameters]'
            ),
            array(
                'id' => 'stability/stable-diffusion-3-5',
                'name' => 'Stable Diffusion 3.5 Large',
                'slug' => 'stable-diffusion-3-5',
                'provider' => 'Stability AI',
                'providerSlug' => 'stability',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '4.2 sec/img',
                'ttft' => '320ms',
                'providersCount' => 20,
                'contextWindow' => 'Text-to-Image',
                'inputPrice' => '$0.035 / img',
                'outputPrice' => '$0.035 / img',
                'tagline' => 'Stability AI flagship open-weights image foundation model with 8.1B Multimodal Diffusion Transformer.',
                'summary' => 'Stable Diffusion 3.5 Large is Stability AI most powerful open-weights image generator. Featuring an 8.1 billion parameter Multimodal Diffusion Transformer (MMDiT) backbone, it delivers photorealism, typography rendering, and prompt adherence under a permissive Community License.',
                'architecture' => '8.1B parameter Multimodal Diffusion Transformer (MMDiT) with separate weights for image and text tokens and flow matching.',
                'keyCapabilities' => array(
                    'Massive 8.1B capacity enables rich fine details, micro-textures, and complex compositions.',
                    'Permissive Stability Community License allows free commercial use for revenue under $1M/year.',
                    'Industry-leading typography rendering for posters, packaging, and digital advertisements.',
                    'Rich ecosystem of community LoRAs, ControlNets, and ComfyUI workflow nodes.'
                ),
                'benchmarks' => array(
                    'Prompt Adherence (GenEval)' => '0.78 overall score',
                    'Typography Accuracy' => '86.5% correct letter rendering',
                    'Aesthetic Quality Score' => '4.28 / 5 MOS'
                ),
                'googleSynergy' => 'Deploys on Google Cloud Vertex AI custom endpoints with NVIDIA L4 or A100 GPUs.',
                'samplePrompt' => 'An editorial fashion portrait of a model wearing an iridescent prism coat, neon studio lighting, shot on 35mm film with grain.',
                'sampleOutput' => '[Photorealistic 1024x1024 fashion editorial image with accurate fabric refractions and film grain]'
            ),
            array(
                'id' => 'recraft/recraft-v3',
                'name' => 'Recraft V3',
                'slug' => 'recraft-v3',
                'provider' => 'Recraft',
                'providerSlug' => 'bfl',
                'category' => 'image',
                'categoryName' => 'Image Generation & Vision',
                'throughput' => '5 sec/img',
                'ttft' => '350ms',
                'providersCount' => 12,
                'contextWindow' => 'Vector & Raster Synthesis',
                'inputPrice' => '$0.04 / img',
                'outputPrice' => '$0.04 / img',
                'tagline' => 'Frontier design-focused model generating clean SVG vector art, 3D icons, and brand graphics with text.',
                'summary' => 'Recraft V3 is the undisputed leader in graphic design and vector synthesis. Unlike standard raster diffusion models, Recraft natively generates production-ready vector graphics (SVG), 3D isometric icons, logo designs, and brand illustrations with typographic precision.',
                'architecture' => 'Specialized design diffusion transformer trained on millions of curated vector graphics, layouts, and brand identity systems.',
                'keyCapabilities' => array(
                    'Direct export to scalable vector graphics (SVG) with clean bezier paths and groups.',
                    'Consistent brand color palette enforcement and brand kit integration.',
                    'Flawless typography rendering integrated into badges, logos, and UI banners.',
                    'Supports 3D icons, flat vector illustrations, pixel art, and hyperrealistic raster imagery.'
                ),
                'benchmarks' => array(
                    'Hugging Face Text-to-Image Leaderboard' => '#1 Global Rank on Graphic Design',
                    'Vector Cleanliness' => '98% valid SVG path rendering',
                    'Typography Benchmark' => '92.0% correct brand text generation'
                ),
                'googleSynergy' => 'Complements Google Workspace and web design pipelines with instant vector asset generation.',
                'samplePrompt' => 'Clean SVG vector logo for a cloud cybersecurity firm named "Aegis Cloud", minimalist shield and network nodes, modern gradient.',
                'sampleOutput' => '[Production-ready SVG vector code with clean bezier curves, grouped layers, and sharp gradient fills]'
            )
        );

        return $models_list;
    }
}

if (!function_exists('googleaitools_get_model_by_slug')) {
    function googleaitools_get_model_by_slug($slug) {
        $models = googleaitools_get_models_data();
        foreach ($models as $m) {
            if ($m['slug'] === $slug || $m['id'] === $slug || ($slug === 'gemini-4' && $m['slug'] === 'gemini-4-hydrogen')) {
                return $m;
            }
        }
        return null;
    }
}

if (!function_exists('googleaitools_get_models_by_category')) {
    function googleaitools_get_models_by_category($cat_slug) {
        $models = googleaitools_get_models_data();
        $filtered = array();
        foreach ($models as $m) {
            if ($m['category'] === $cat_slug) {
                $filtered[] = $m;
            }
        }
        return $filtered;
    }
}

if (!function_exists('googleaitools_get_fastest_models')) {
    function googleaitools_get_fastest_models($limit = 5) {
        $fastest = googleaitools_get_models_by_category('fastest');
        return array_slice($fastest, 0, $limit);
    }
}

if (!function_exists('googleaitools_get_value_models')) {
    function googleaitools_get_value_models($limit = 5) {
        $value = googleaitools_get_models_by_category('value');
        return array_slice($value, 0, $limit);
    }
}

if (!function_exists('googleaitools_get_models_list')) {
    function googleaitools_get_models_list() {
        return googleaitools_get_models_data();
    }
}


