# Contributing to Awesome Google AI Tools

Thank you for your interest in contributing to **Awesome Google AI Tools**! We welcome community contributions to keep this directory and the structured comparison tables accurate, comprehensive, and up-to-date.

---

## 📋 Quality Standards & Guidelines

Before opening a Pull Request, please ensure your submission meets these standards:

1. **Relevance**: The item must be an official Google AI tool, model, framework, SDK, research breakthrough, or a prominent community integration (e.g., Ollama runner for Gemma, LangChain Google provider).
2. **Quality & Verification**: Verify that links are live and not behind non-functional redirects.
3. **Format**: Follow the existing Markdown list format:
   ```markdown
   - [Tool Name](https://link-to-tool) - Concise description explaining what it is, its core feature, and primary use case.
   ```
4. **Structured Comparison Tables**: If you are adding or updating a model in the comparison tables, please update both:
   - The tables in `README.md`
   - The dataset in `data/comparison-matrix.json`
   - The CSV in `data/models-comparison.csv`
5. **No Duplicate Entries**: Use `Ctrl+F` or `grep` to verify the tool or paper is not already listed in another section.
6. **Neutral, Technical Descriptions**: Avoid marketing hype ("the best AI ever"). Use factual, metric-grounded specifications (e.g., context window size, latency, parameter counts).

---

## 🛠️ Step-by-Step Contribution Workflow

1. **Fork the Repository** on GitHub.
2. **Clone your fork locally**:
   ```bash
   git clone https://github.com/<your-username>/awesome-google-ai-tools.git
   cd awesome-google-ai-tools
   ```
3. **Create a topic branch**:
   ```bash
   git checkout -b add/new-google-model
   ```
4. **Make your additions**:
   - Add your entry alphabetically or grouped logically in the appropriate category.
5. **Commit your changes**:
   ```bash
   git commit -m "Add PaliGemma 2 benchmark to comparison matrix"
   ```
6. **Push to your fork & open a Pull Request**:
   ```bash
   git push origin add/new-google-model
   ```

---

## 🤝 Attribution & Companion Community

This repository is maintained in pairing with [googleaitools.com](https://googleaitools.com). If you write in-depth tutorials, benchmarks, or case studies on Google AI, mention them in your PR for inclusion in the Tutorials section!
