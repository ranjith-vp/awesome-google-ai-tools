/**
 * ==========================================================================
 * CENTRAL POSTS REGISTRY - googleaitools.com
 * ==========================================================================
 * All blog posts, tutorials, and tool reviews are registered here.
 * Adding a post to this file automatically updates:
 * 1. Homepage Products Grid
 * 2. Category Pages
 * 3. Recent / Related Articles
 * 4. Site Search Index
 * 5. Automatic Sitemaps
 * ==========================================================================
 */

const SITE_CATEGORIES = [
  { id: 'all', name: 'All AI Tools', icon: '✨' },
  { id: 'multimodal', name: 'Multimodal AI', icon: '🧠' },
  { id: 'research', name: 'Research & Productivity', icon: '📚' },
  { id: 'image-video', name: 'Image & Video AI', icon: '🎨' },
  { id: 'open-source', name: 'Open Source Models', icon: '⚡' },
  { id: 'developer', name: 'Developer & APIs', icon: '💻' }
];

const POSTS_DATA = [
  {
    id: 'how-to-use-gemini-15-flash',
    title: 'How to Use Gemini 1.5 Flash',
    slug: 'how-to-use-gemini-15-flash',
    url: 'posts/how-to-use-gemini-15-flash.html',
    category: 'multimodal',
    categoryName: 'Multimodal AI',
    date: '2026-08-16',
    author: { name: 'Dr. Alex Mercer', avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80', role: 'AI Specialist' },
    readTime: '6 min read',
    excerpt: 'A beginner guide to building fast applications with Gemini 1.5 Flash.',
    icon: '✨',
    featured: false,
    tags: ['Google AI']
  },
  {
    id: 'getting-started-with-gemini-1-5-pro',
    title: 'Getting Started with Gemini 1.5 Pro: The 2 Million Token Context Revolution',
    slug: 'getting-started-with-gemini-1-5-pro',
    url: 'posts/getting-started-with-gemini-1-5-pro.html',
    category: 'multimodal',
    categoryName: 'Multimodal AI',
    date: '2026-08-15',
    author: {
      name: 'Dr. Alex Mercer',
      avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80',
      role: 'Chief AI Architect'
    },
    readTime: '8 min read',
    excerpt: 'Explore how Google’s Gemini 1.5 Pro enables seamless analysis across 2 million tokens of code, video, audio, and documents in a single prompt.',
    icon: '✨',
    featured: true,
    tags: ['Gemini', 'Multimodal', 'Developer', 'LLM']
  },
  {
    id: 'notebooklm-ai-research-guide',
    title: 'NotebookLM Ultimate Guide: Transform Notes & PDFs into Audio Overviews',
    slug: 'notebooklm-ai-research-guide',
    url: 'posts/notebooklm-ai-research-guide.html',
    category: 'research',
    categoryName: 'Research & Productivity',
    date: '2026-08-14',
    author: {
      name: 'Sarah Chen',
      avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80',
      role: 'AI Productivity Specialist'
    },
    readTime: '6 min read',
    excerpt: 'How Google NotebookLM uses Gemini 1.5 to automatically grounded research notes, synthesize complex PDFs, and generate studio-quality podcast audio overviews.',
    icon: '📓',
    featured: true,
    tags: ['NotebookLM', 'Research', 'Productivity', 'Audio']
  },
  {
    id: 'imagen-3-prompt-engineering-tips',
    title: 'Imagen 3 Prompt Engineering Masterclass: Photorealistic AI Image Generation',
    slug: 'imagen-3-prompt-engineering-tips',
    url: 'posts/imagen-3-prompt-engineering-tips.html',
    category: 'image-video',
    categoryName: 'Image & Video AI',
    date: '2026-08-12',
    author: {
      name: 'Elena Rostova',
      avatar: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&auto=format&fit=crop&q=80',
      role: 'Creative Tech Director'
    },
    readTime: '7 min read',
    excerpt: 'Master Google Imagen 3 with advanced lighting, texture, and composition prompt strategies for hyper-realistic visual asset generation.',
    icon: '🖼️',
    featured: false,
    tags: ['Imagen 3', 'Image Generation', 'Prompts', 'Design']
  },
  {
    id: 'google-veo-video-generation-tutorial',
    title: 'Google Veo Deep Dive: High-Definition 1080p AI Video Generation',
    slug: 'google-veo-video-generation-tutorial',
    url: 'posts/google-veo-video-generation-tutorial.html',
    category: 'image-video',
    categoryName: 'Image & Video AI',
    date: '2026-08-10',
    author: {
      name: 'Marcus Vance',
      avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80',
      role: 'Video & Motion AI Engineer'
    },
    readTime: '10 min read',
    excerpt: 'Google Veo brings generative video to Hollywood standards. Learn visual consistency, cinematic controls, and video editing techniques with Veo.',
    icon: '🎥',
    featured: true,
    tags: ['Veo', 'Video AI', 'Cinematics', 'Generative Media']
  },
  {
    id: 'gemma-open-source-ai-models-guide',
    title: 'Gemma 2 Open Models: Fine-Tuning Lightweight AI on Local Hardware',
    slug: 'gemma-open-source-ai-models-guide',
    url: 'posts/gemma-open-source-ai-models-guide.html',
    category: 'open-source',
    categoryName: 'Open Source Models',
    date: '2026-08-08',
    author: {
      name: 'Dr. Alex Mercer',
      avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80',
      role: 'Chief AI Architect'
    },
    readTime: '9 min read',
    excerpt: 'Complete tutorial on deploying and fine-tuning Google Gemma 2 2B, 9B, and 27B open weights models locally using PyTorch, HuggingFace, and Ollama.',
    icon: '⚡',
    featured: false,
    tags: ['Gemma', 'Open Source', 'Ollama', 'Fine-Tuning']
  }
];
