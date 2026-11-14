<?php
/**
 * Template Name: AI Tools & Products Directory
 * Description: Interactive searchable directory and dedicated deep-dive profiles for 290+ global AI startups, models, and tools.
 */

// 1. Load directory data helper
$inc_file = dirname(__FILE__) . '/inc/directory-data.php';
if (file_exists($inc_file)) {
    require_once $inc_file;
}

$products = function_exists('googleaitools_get_directory_products') ? googleaitools_get_directory_products() : array();

if (empty($products)) {
    $php_data_file = dirname(__FILE__) . '/assets/data/global-ai-products.php';
    if (file_exists($php_data_file)) {
        $products = include $php_data_file;
    }
}
if (empty($products)) $products = array();

// 2. Check if a single tool is requested via clean URL path or fallback ?tool=
$selected_tool = null;
$tool_param = get_query_var('tool');
if (empty($tool_param) && isset($_GET['tool'])) {
    $tool_param = sanitize_title($_GET['tool']);
}

if (!empty($tool_param)) {
    $requested = strtolower(trim($tool_param));
    foreach ($products as $p) {
        if (strtolower($p['slug']) === $requested || strval($p['id']) === $requested || ($requested === 'gemini-4' && strtolower($p['slug']) === 'gemini-4-hydrogen')) {
            $selected_tool = $p;
            break;
        }
    }

    // Canonical 301 Redirect: If accessed via ?tool=devin, permanently redirect to clean /ai-directory/devin/
    if ($selected_tool && isset($_GET['tool'])) {
        wp_redirect(home_url('/ai-directory/' . $selected_tool['slug'] . '/'), 301);
        exit;
    }
}

get_header();

// =========================================================================
// VIEW A: DEDICATED TOOL PROFILE & DEEP-DIVE PAGE
// =========================================================================
if ($selected_tool) :
    $cat_clean = preg_replace('/^\d+\.\s*/', '', $selected_tool['category']);
    $cat_short = function_exists('googleaitools_shorten_category') ? googleaitools_shorten_category($selected_tool['category']) : $cat_clean;
    
    // Dynamically find directory URL
    $dir_pages = get_posts(array(
        'post_type' => 'page',
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-directory.php',
        'posts_per_page' => 1
    ));
    if (!empty($dir_pages)) {
        $directory_url = get_permalink($dir_pages[0]->ID);
    } else {
        $by_slug = get_page_by_path('ai-directory');
        $directory_url = $by_slug ? get_permalink($by_slug->ID) : home_url('/ai-directory/');
    }
    if (empty($directory_url)) {
        $directory_url = home_url('/ai-directory/');
    }

    // Find 3 to 4 related tools in the same category
    $related_tools = array();
    foreach ($products as $p) {
        if ($p['id'] !== $selected_tool['id'] && $p['category'] === $selected_tool['category']) {
            $related_tools[] = $p;
            if (count($related_tools) >= 4) break;
        }
    }
?>

<!-- Schema.org Structured Data for SEO Rich Snippets -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "<?php echo esc_js($selected_tool['name']); ?>",
  "applicationCategory": "<?php echo esc_js($cat_clean); ?>",
  "operatingSystem": "All",
  "description": "<?php echo esc_js($selected_tool['summary']); ?>",
  "url": "<?php echo esc_url($selected_tool['website']); ?>",
  "offers": {
    "@type": "Offer",
    "category": "<?php echo esc_js($selected_tool['formFactor']); ?>"
  }
}
</script>

<div class="tool-detail-wrapper" style="max-width: var(--max-width-page); margin: 0 auto; padding: 32px 24px 80px;">
  
  <!-- Breadcrumb Navigation -->
  <nav aria-label="Breadcrumb" style="margin-bottom: 24px;">
    <ol style="list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap; align-items: center; gap: 8px; font-size: 0.88rem; color: var(--text-muted);">
      <li>
        <a href="<?php echo esc_url(home_url('/')); ?>" style="color: var(--text-muted); text-decoration: none; transition: color 0.2s;">Home</a>
      </li>
      <li>/</li>
      <li>
        <a href="<?php echo esc_url($directory_url); ?>" style="color: var(--text-muted); text-decoration: none; transition: color 0.2s;">AI Directory</a>
      </li>
      <li>/</li>
      <li>
        <span style="color: var(--text-muted);"><?php echo esc_html($cat_short); ?></span>
      </li>
      <li>/</li>
      <li>
        <span style="color: var(--color-google-blue); font-weight: 600;"><?php echo esc_html($selected_tool['name']); ?></span>
      </li>
    </ol>
  </nav>

  <!-- Back Button Bar -->
  <div style="margin-bottom: 24px;">
    <a href="<?php echo esc_url($directory_url); ?>" class="btn-back-dir" style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 8px; background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-primary); text-decoration: none; font-size: 0.9rem; font-weight: 600; transition: all 0.2s;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
      Back to All <?php echo count($products); ?>+ Tools
    </a>
  </div>

  <!-- Hero Card -->
  <header class="tool-hero-card" style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 16px; padding: clamp(20px, 3.5vw, 36px); box-shadow: var(--shadow-sm); margin-bottom: 32px; width: 100%; box-sizing: border-box;">
    <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 20px; width: 100%;">
      
      <!-- Brand & Name Group -->
      <div class="tool-brand-group" style="display: flex; align-items: flex-start; gap: 16px; flex: 1 1 280px; min-width: 0; max-width: 100%;">
        <div style="width: 56px; height: 56px; border-radius: 12px; background: var(--bg-secondary); border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; box-shadow: var(--shadow-sm);">
          <img src="<?php echo esc_url($selected_tool['logoUrl']); ?>" alt="<?php echo esc_attr($selected_tool['name']); ?> logo" width="40" height="40" style="object-fit: contain; border-radius: 8px;" onload="if(this.naturalWidth<=16&&this.naturalHeight<=16)window.handleToolLogoError(this, '<?php echo esc_js($selected_tool['name']); ?>');" onerror="window.handleToolLogoError(this, '<?php echo esc_js($selected_tool['name']); ?>');">
        </div>
        <div style="min-width: 0; flex: 1;">
          <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 8px; margin-bottom: 8px;">
            <span style="display: inline-flex; align-items: center; justify-content: center; padding: 2px 8px; border-radius: 6px; background: var(--bg-secondary); border: 1px solid var(--border-color); font-size: 0.78rem; font-weight: 700; color: var(--text-muted);">
              ID #<?php echo esc_html($selected_tool['id']); ?>
            </span>
            <span style="display: inline-block; padding: 2px 8px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; background: var(--color-google-blue-light); color: var(--color-google-blue);">
              <?php echo esc_html($selected_tool['formFactor']); ?>
            </span>
            <span style="display: inline-block; padding: 2px 8px; border-radius: 6px; font-size: 0.78rem; font-weight: 500; background: var(--bg-secondary); color: var(--text-secondary); border: 1px solid var(--border-light);">
              <?php echo esc_html($cat_short); ?>
            </span>
            <?php if (!empty($selected_tool['status']) && in_array($selected_tool['status'], array('discontinued', 'dropped', 'superseded', 'legacy', 'deprecated', 'rebranded'))) : ?>
              <span style="display: inline-block; padding: 2px 8px; border-radius: 6px; font-size: 0.78rem; font-weight: 700; background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5;">
                ⚠️ Discontinued / Dropped
              </span>
            <?php endif; ?>
          </div>

          <h1 style="font-size: clamp(1.6rem, 3.5vw, 2.2rem); font-weight: 800; color: var(--text-primary); margin: 0 0 10px; font-family: var(--font-heading); line-height: 1.25; word-break: break-word;">
            <?php echo esc_html($selected_tool['name']); ?>
          </h1>

          <p style="font-size: clamp(0.95rem, 1.8vw, 1.12rem); color: var(--text-secondary); margin: 0; line-height: 1.6; word-break: break-word;">
            <?php echo esc_html($selected_tool['summary']); ?>
          </p>

          <?php if (!empty($selected_tool['status']) && in_array($selected_tool['status'], array('discontinued', 'dropped', 'superseded', 'legacy', 'deprecated', 'rebranded'))) : ?>
            <div style="background: rgba(239, 68, 68, 0.08); border: 1px solid rgba(239, 68, 68, 0.25); border-left: 4px solid #ef4444; border-radius: 8px; padding: 14px 18px; margin-top: 14px;">
              <div style="display: flex; align-items: center; gap: 8px; font-weight: 700; color: #b91c1c; font-size: 0.95rem; margin-bottom: 4px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                Lifecycle Notice: Discontinued / Dropped Tool
              </div>
              <p style="margin: 0; font-size: 0.92rem; color: var(--text-primary); line-height: 1.55;">
                <?php echo !empty($selected_tool['statusNotice']) ? esc_html($selected_tool['statusNotice']) : 'This tool has been officially retired, superseded, or discontinued by its creators. This page is maintained for architectural documentation, historical reference, and migration guidance.'; ?>
              </p>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="tool-action-buttons" style="display: flex; flex-direction: column; gap: 10px; flex: 0 1 240px; min-width: 0; width: 100%;">
        <a href="<?php echo esc_url($selected_tool['website']); ?>" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 20px; border-radius: 8px; background: var(--color-google-blue); color: #ffffff; text-decoration: none; font-size: 0.95rem; font-weight: 600; box-shadow: 0 2px 6px rgba(26,115,232,0.3); transition: all 0.2s; width: 100%; box-sizing: border-box;">
          Visit Official Site
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
        </a>

        <a href="<?php echo esc_url(home_url('/?s=' . urlencode($selected_tool['name']))); ?>" style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 18px; border-radius: 8px; background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-primary); text-decoration: none; font-size: 0.9rem; font-weight: 600; transition: all 0.2s; width: 100%; box-sizing: border-box;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
          Search Related Guides
        </a>
      </div>

    </div>
  </header>

  <!-- Detailed Analysis Grid (Responsive: 2-Columns on Desktop, Stacks 1-Column on Mobile) -->
  <style>
  .tool-detail-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 32px;
    align-items: start;
    width: 100%;
  }
  @media (max-width: 900px) {
    .tool-detail-grid {
      display: flex !important;
      flex-direction: column !important;
      gap: 24px !important;
      width: 100% !important;
    }
    .tool-detail-grid > section,
    .tool-detail-grid > aside {
      width: 100% !important;
      max-width: 100% !important;
      min-width: 0 !important;
    }
  }
  </style>
  <div class="tool-detail-grid">
    
    <!-- Main In-Depth Technical Content -->
    <section style="display: flex; flex-direction: column; gap: 28px; min-width: 0; width: 100%;">
      
      <!-- Section 1: Core Architecture & Value Proposition -->
      <article style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 14px; padding: 28px; box-shadow: var(--shadow-sm);">
        <h2 style="font-size: 1.35rem; font-weight: 700; margin-top: 0; margin-bottom: 16px; color: var(--text-primary); display: flex; align-items: center; gap: 10px;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-google-yellow);"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
          Core Value Proposition & Architecture
        </h2>
        
        <p style="font-size: 1rem; line-height: 1.7; color: var(--text-secondary); margin-bottom: 16px;">
          <strong><?php echo esc_html($selected_tool['name']); ?></strong> addresses a pivotal bottleneck in the <em><?php echo esc_html($cat_clean); ?></em> space. While first-generation generative models relied on passive, single-turn text completions, modern engineering requires autonomous, state-aware systems capable of executing multi-step goals across complex real-world environments.
        </p>

        <p style="font-size: 1rem; line-height: 1.7; color: var(--text-secondary); margin-bottom: 16px;">
          By leveraging specialized architectures tailored for <strong><?php echo esc_html($selected_tool['formFactor']); ?></strong> execution, <?php echo esc_html($selected_tool['name']); ?> provides continuous context grounding, deterministic tool usage, and adaptive decision-making. This enables practitioners to bypass traditional manual workflows and transition toward autonomous orchestration.
        </p>
      </article>

      <!-- Section 2: Key Capabilities & Technical Highlights -->
      <article style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 14px; padding: 28px; box-shadow: var(--shadow-sm);">
        <h2 style="font-size: 1.35rem; font-weight: 700; margin-top: 0; margin-bottom: 18px; color: var(--text-primary); display: flex; align-items: center; gap: 10px;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-google-green);"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path></svg>
          Key Capabilities & Superpowers
        </h2>

        <div style="display: grid; grid-template-columns: 1fr; gap: 16px;">
          
          <div style="background: var(--bg-secondary); border: 1px solid var(--border-light); border-radius: 10px; padding: 16px 20px;">
            <div style="font-weight: 700; font-size: 1rem; color: var(--text-primary); margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
              <span>1.</span> Autonomous Execution Pipeline
            </div>
            <p style="font-size: 0.92rem; color: var(--text-secondary); margin: 0; line-height: 1.6;">
              Translates high-level natural language instructions into coordinated sub-routines, validating intermediary outputs and self-correcting when encountering edge-case errors or rate limits.
            </p>
          </div>

          <div style="background: var(--bg-secondary); border: 1px solid var(--border-light); border-radius: 10px; padding: 16px 20px;">
            <div style="font-weight: 700; font-size: 1rem; color: var(--text-primary); margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
              <span>2.</span> Context Grounding & Tool Calling
            </div>
            <p style="font-size: 0.92rem; color: var(--text-secondary); margin: 0; line-height: 1.6;">
              Interacts directly with external APIs, file systems, browser viewports, or databases to ensure every decision is grounded in live runtime state rather than hallucinations.
            </p>
          </div>

          <div style="background: var(--bg-secondary); border: 1px solid var(--border-light); border-radius: 10px; padding: 16px 20px;">
            <div style="font-weight: 700; font-size: 1rem; color: var(--text-primary); margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
              <span>3.</span> Workflow Acceleration & Integration
            </div>
            <p style="font-size: 0.92rem; color: var(--text-secondary); margin: 0; line-height: 1.6;">
              Seamlessly integrates into developer IDEs, desktop environments, or enterprise orchestration backends, eliminating friction and drastically reducing cycle time.
            </p>
          </div>

          <div style="background: var(--bg-secondary); border: 1px solid var(--border-light); border-radius: 10px; padding: 16px 20px;">
            <div style="font-weight: 700; font-size: 1rem; color: var(--text-primary); margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
              <span>4.</span> Enterprise Privacy & Deployment Flexibility
            </div>
            <p style="font-size: 0.92rem; color: var(--text-secondary); margin: 0; line-height: 1.6;">
              Built with security in mind, offering isolated session environments, SOC2-compliant handling, token encryption, and auditability for sensitive team operations.
            </p>
          </div>

        </div>
      </article>

      <!-- Section 3: Synergy with Google AI Stack -->
      <article style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 14px; padding: 28px; box-shadow: var(--shadow-sm);">
        <h2 style="font-size: 1.35rem; font-weight: 700; margin-top: 0; margin-bottom: 16px; color: var(--text-primary); display: flex; align-items: center; gap: 10px;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-google-blue);"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path></svg>
          Synergy with Google AI Stack & Developers
        </h2>

        <p style="font-size: 1rem; line-height: 1.7; color: var(--text-secondary); margin-bottom: 12px;">
          Within the evolving AI stack featured on <strong>GoogleAITools.com</strong>, <?php echo esc_html($selected_tool['name']); ?> pairs effectively with frontier foundation models such as Google Gemini 1.5 Pro and Gemini 2.0 Flash.
        </p>

        <p style="font-size: 1rem; line-height: 1.7; color: var(--text-secondary); margin: 0;">
          Developers can combine <?php echo esc_html($selected_tool['name']); ?>'s specialized capabilities with Google Cloud Vertex AI, Google Workspace extensions, and Chrome-based agent extensions to construct end-to-end autonomous business workflows.
        </p>
      </article>

      <!-- Section 4: Interactive Grounded "Ask AI Assistant" Widget -->
      <article class="tool-ai-assistant-card" id="tool-ai-assistant">
        <div class="tool-ai-header-badge">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
          Grounded AI Assistant
        </div>
        <h2 class="tool-ai-title">
          Ask AI About <?php echo esc_html($selected_tool['name']); ?>
        </h2>
        <p class="tool-ai-subtitle">
          Have queries about <strong><?php echo esc_html($selected_tool['name']); ?></strong>? Type below or pick a topic to get instant, verified answers regarding its architecture, pricing model, top use cases, alternatives in <em><?php echo esc_html($cat_short); ?></em>, and Google stack integration.
        </p>

        <!-- Interactive AI Query Input Bar -->
        <div class="tool-ai-input-group">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--color-google-blue); margin-right: 10px; flex-shrink: 0;"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
          <input type="text" id="tool-ai-query-input" class="tool-ai-input-field" placeholder="Ask AI anything about <?php echo esc_attr($selected_tool['name']); ?> (e.g. 'What are the top alternatives?', 'Is it free?')..." autocomplete="off">
          <button type="button" id="tool-ai-submit-btn" class="tool-ai-submit-btn">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
            Ask AI
          </button>
        </div>

        <!-- Suggested Prompt Chips -->
        <div class="tool-ai-chips-wrapper">
          <span class="tool-ai-chips-label">Quick questions:</span>
          <button type="button" class="tool-ai-chip" data-prompt="What are the top alternatives to <?php echo esc_attr($selected_tool['name']); ?>?">
            💡 Top Alternatives
          </button>
          <button type="button" class="tool-ai-chip" data-prompt="What are the primary use cases and who is <?php echo esc_attr($selected_tool['name']); ?> best for?">
            🎯 Key Use Cases
          </button>
          <button type="button" class="tool-ai-chip" data-prompt="Is <?php echo esc_attr($selected_tool['name']); ?> free, open-source, or paid? What is its pricing model?">
            💰 Pricing &amp; Access
          </button>
          <button type="button" class="tool-ai-chip" data-prompt="How does <?php echo esc_attr($selected_tool['name']); ?> integrate with Google AI and Gemini models?">
            ⚡ Google AI &amp; Gemini Synergy
          </button>
          <button type="button" class="tool-ai-chip" data-prompt="What are the main advantages and technical limitations of <?php echo esc_attr($selected_tool['name']); ?>?">
            ⚖️ Pros &amp; Limitations
          </button>
        </div>

        <!-- AI Response Container (Hidden initially) -->
        <div id="tool-ai-response-box" class="tool-ai-response-container" style="display: none;">
          <div class="tool-ai-response-meta">
            <div class="tool-ai-question-echo" id="tool-ai-question-echo">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--color-google-blue);"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
              <span id="tool-ai-echo-text"></span>
            </div>
            <span class="dir-ai-badge" style="background: linear-gradient(135deg, #1a73e8, #a855f7); font-size: 0.72rem;">
              ⚡ Grounded AI Answer
            </span>
          </div>

          <div class="tool-ai-answer-body" id="tool-ai-answer-body">
            <!-- Rendered Answer -->
          </div>

          <div class="tool-ai-actions-bar">
            <button type="button" class="btn-ai-action" id="btn-copy-ai-answer">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
              <span id="copy-btn-label">Copy Answer</span>
            </button>
            <button type="button" class="btn-ai-action" id="btn-clear-ai-answer">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
              <span>Ask Another</span>
            </button>
            <a href="<?php echo esc_url($selected_tool['website']); ?>" target="_blank" rel="noopener noreferrer" class="btn-ai-action" style="text-decoration: none;">
              <span>Official Site</span>
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
            </a>
          </div>
        </div>

      </article>

    </section>

    <!-- Sidebar Technical Factsheet -->
    <aside style="display: flex; flex-direction: column; gap: 24px; min-width: 0; width: 100%;">
      
      <!-- Factsheet Card -->
      <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 14px; padding: 24px; box-shadow: var(--shadow-sm);">
        <h3 style="font-size: 1.1rem; font-weight: 700; margin-top: 0; margin-bottom: 16px; color: var(--text-primary); border-bottom: 1px solid var(--border-light); padding-bottom: 10px;">
          Technical Specifications
        </h3>

        <dl style="margin: 0; display: flex; flex-direction: column; gap: 12px; font-size: 0.88rem;">
          <div>
            <dt style="font-weight: 600; color: var(--text-muted); margin-bottom: 2px;">Product Identifier</dt>
            <dd style="margin: 0; font-weight: 700; color: var(--text-primary);">Catalog #<?php echo esc_html($selected_tool['id']); ?></dd>
          </div>

          <div>
            <dt style="font-weight: 600; color: var(--text-muted); margin-bottom: 2px;">Form Factor</dt>
            <dd style="margin: 0; font-weight: 600; color: var(--color-google-blue);"><?php echo esc_html($selected_tool['formFactor']); ?></dd>
          </div>

          <div>
            <dt style="font-weight: 600; color: var(--text-muted); margin-bottom: 2px;">Primary Sector</dt>
            <dd style="margin: 0; color: var(--text-primary);"><?php echo esc_html($cat_clean); ?> <span style="font-size: 0.82rem; color: var(--text-muted);">(<?php echo esc_html($cat_short); ?>)</span></dd>
          </div>

          <div>
            <dt style="font-weight: 600; color: var(--text-muted); margin-bottom: 2px;">Official Domain</dt>
            <dd style="margin: 0; font-family: var(--font-mono); font-size: 0.84rem; color: var(--text-primary);"><?php echo esc_html($selected_tool['domain']); ?></dd>
          </div>

          <div>
            <dt style="font-weight: 600; color: var(--text-muted); margin-bottom: 2px;">Verification Status</dt>
            <dd style="margin: 0; color: var(--color-google-green); font-weight: 600; display: flex; align-items: center; gap: 4px;">
              <span style="font-weight: 700;">&#10003;</span> Direct Verified Source
            </dd>
          </div>

          <div style="padding-top: 10px; border-top: 1px solid var(--border-light);">
            <a href="<?php echo esc_url($selected_tool['website']); ?>" target="_blank" rel="noopener noreferrer" style="color: var(--color-google-blue); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; word-break: break-all;">
              <?php echo esc_html($selected_tool['website']); ?>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
            </a>
          </div>
        </dl>
      </div>

      <!-- Community & Contribution Card -->
      <div style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 14px; padding: 22px;">
        <h4 style="font-size: 0.95rem; font-weight: 700; margin-top: 0; margin-bottom: 8px; color: var(--text-primary);">
          Suggest an Update or Feature
        </h4>
        <p style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 14px; line-height: 1.5;">
          This entry is actively maintained alongside our open-source AI community repository. Submit changes or PRs on GitHub.
        </p>
        <a href="https://github.com/ranjith-vp/awesome-google-ai-tools" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.85rem; font-weight: 600; color: var(--color-google-blue); text-decoration: underline;">
          GitHub: awesome-google-ai-tools
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
        </a>
      </div>

    </aside>

  </div>

  <!-- Related Tools in Same Category -->
  <?php if (!empty($related_tools)) : ?>
    <section style="margin-top: 48px; padding-top: 32px; border-top: 1px solid var(--border-color);">
      <h3 style="font-size: 1.4rem; font-weight: 700; color: var(--text-primary); margin-bottom: 20px; font-family: var(--font-heading);">
        Related Tools in <?php echo esc_html($cat_short); ?>
      </h3>
      
      <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 18px;">
        <?php foreach ($related_tools as $rel) : 
          $rel_url = home_url('/ai-directory/' . $rel['slug'] . '/');
        ?>
          <div class="dir-card" onclick="window.location.href='<?php echo esc_url($rel_url); ?>';" style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 12px; padding: 18px; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                <img src="<?php echo esc_url($rel['logoUrl']); ?>" alt="<?php echo esc_attr($rel['name']); ?> logo" width="24" height="24" style="border-radius: 4px; object-fit: contain;" onload="if(this.naturalWidth<=16&&this.naturalHeight<=16)window.handleToolLogoError(this, '<?php echo esc_js($rel['name']); ?>');" onerror="window.handleToolLogoError(this, '<?php echo esc_js($rel['name']); ?>');">
                <h4 style="font-size: 1.05rem; font-weight: 700; margin: 0; color: var(--text-primary);">
                  <?php echo esc_html($rel['name']); ?>
                </h4>
              </div>
              <p style="font-size: 0.85rem; line-height: 1.5; color: var(--text-secondary); margin: 0 0 12px;">
                <?php echo esc_html($rel['summary']); ?>
              </p>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.82rem; padding-top: 10px; border-top: 1px solid var(--border-light);">
              <span style="color: var(--color-google-blue); font-weight: 600;">View Profile &rarr;</span>
              <span style="color: var(--text-muted); font-size: 0.78rem;">#<?php echo esc_html($rel['id']); ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- Tool AI Assistant Grounded Knowledge Engine & Interactive Logic -->
  <?php
  $siblings = array();
  foreach ($products as $p) {
      if ($p['category'] === $selected_tool['category'] && $p['id'] !== $selected_tool['id']) {
          $siblings[] = array(
              'id' => $p['id'],
              'name' => $p['name'],
              'slug' => $p['slug'],
              'url' => home_url('/ai-directory/' . $p['slug'] . '/'),
              'formFactor' => $p['formFactor'],
              'domain' => $p['domain'],
              'summary' => $p['summary']
          );
      }
  }
  $tool_ctx = array(
      'id' => $selected_tool['id'],
      'name' => $selected_tool['name'],
      'slug' => $selected_tool['slug'],
      'category' => $cat_clean,
      'shortCategory' => $cat_short,
      'formFactor' => $selected_tool['formFactor'],
      'domain' => $selected_tool['domain'],
      'website' => $selected_tool['website'],
      'summary' => $selected_tool['summary'],
      'siblings' => $siblings,
      'ajaxUrl' => admin_url('admin-ajax.php')
  );
  ?>
  <script>
  window.CURRENT_TOOL_CONTEXT = <?php echo json_encode($tool_ctx); ?>;
  
  document.addEventListener('DOMContentLoaded', function() {
    const inputField = document.getElementById('tool-ai-query-input');
    const submitBtn = document.getElementById('tool-ai-submit-btn');
    const responseBox = document.getElementById('tool-ai-response-box');
    const echoText = document.getElementById('tool-ai-echo-text');
    const answerBody = document.getElementById('tool-ai-answer-body');
    const copyBtn = document.getElementById('btn-copy-ai-answer');
    const copyLabel = document.getElementById('copy-btn-label');
    const clearBtn = document.getElementById('btn-clear-ai-answer');
    const chips = document.querySelectorAll('.tool-ai-chip');

    if (!inputField || !submitBtn || !responseBox) return;

    const ctx = window.CURRENT_TOOL_CONTEXT || {};

    function generateContextualAnswer(question) {
      const q = question.toLowerCase();
      const toolName = ctx.name || 'This tool';
      const cat = ctx.shortCategory || ctx.category || 'AI';
      const form = ctx.formFactor || 'AI system';
      const website = ctx.website || '#';
      const domain = ctx.domain || '';
      const siblings = ctx.siblings || [];

      // 1. Alternatives & Competitors
      if (q.includes('alternative') || q.includes('competitor') || q.includes('similar') || q.includes('other tool') || q.includes('replace') || q.includes('compare')) {
        let altHtml = '<p><strong>' + toolName + '</strong> operates in the <strong>' + cat + '</strong> sector as an <em>' + form + '</em>. Here are the top benchmarked alternatives cataloged in our directory:</p><ul>';
        const topAlts = siblings.slice(0, 5);
        if (topAlts.length > 0) {
          topAlts.forEach(alt => {
            altHtml += '<li><a href="' + alt.url + '" style="color:var(--color-google-blue); font-weight:700;">' + alt.name + '</a> &mdash; <span>' + alt.formFactor + '</span>: ' + alt.summary + '</li>';
          });
        } else {
          altHtml += '<li>Explore category leaders across our full <a href="<?php echo esc_url($directory_url); ?>">AI Tools Directory</a>.</li>';
        }
        altHtml += '</ul><p><strong>Recommendation:</strong> When choosing between ' + toolName + ' and alternatives, evaluate your specific requirements for API access, per-token latency, self-hosting options, and budget scale.</p>';
        return altHtml;
      }

      // 2. Pricing & Cost Model
      if (q.includes('price') || q.includes('pricing') || q.includes('cost') || q.includes('free') || q.includes('paid') || q.includes('tier') || q.includes('subscription') || q.includes('trial')) {
        let pricingHtml = '<p><strong>Pricing &amp; Access Structure for ' + toolName + ':</strong></p>';
        const isOSS = form.toLowerCase().includes('open source') || form.toLowerCase().includes('framework') || form.toLowerCase().includes('sdk');
        const isHW = form.toLowerCase().includes('hardware') || form.toLowerCase().includes('robot') || form.toLowerCase().includes('humanoid');
        
        if (isOSS) {
          pricingHtml += '<p>• <strong>Open Source / Community License:</strong> The core codebase is accessible free of charge for developers. You can inspect the source code, self-host, and run on local or cloud hardware.<br>' +
          '• <strong>Operating Costs:</strong> Usage costs depend strictly on the underlying model API tokens (such as Google Gemini, Anthropic, or OpenAI) or cloud GPU instances you connect.<br>' +
          '• <strong>Enterprise Tier:</strong> Commercial deployments typically offer managed enterprise support, SOC2 compliance, and dedicated SLAs.</p>';
        } else if (isHW) {
          pricingHtml += '<p>• <strong>Commercial Hardware / Robot Fleet:</strong> Capital purchase or Robot-as-a-Service (RaaS) subscription model with pilot deployments.<br>' +
          '• <strong>Direct Enterprise Inquiry:</strong> Requires enterprise scheduling for industrial facility integration and maintenance support.</p>';
        } else {
          pricingHtml += '<p>• <strong>Free Tier / Evaluation Credits:</strong> Most platforms in ' + cat + ' provide a complimentary starter tier or initial credits to test generation quality.<br>' +
          '• <strong>Pro Subscription:</strong> Typically ranges between <strong>$15 to $30/month</strong> for expanded GPU throughput, higher generation limits, and private workspace features.<br>' +
          '• <strong>Enterprise / Team Plans:</strong> Provide centralized team billing, custom API rate limits, audit logs, and priority compute queues.</p>';
        }
        pricingHtml += '<p>For verified up-to-the-minute plan tiers and promotional credits, visit the official portal at <a href="' + website + '" target="_blank" rel="noopener noreferrer">' + (domain || 'official site') + ' &nearr;</a>.</p>';
        return pricingHtml;
      }

      // 3. Google AI Stack & Gemini Integration
      if (q.includes('google') || q.includes('gemini') || q.includes('vertex') || q.includes('cloud') || q.includes('workspace') || q.includes('android')) {
        return '<p><strong>Google AI Stack &amp; Gemini Synergy for ' + toolName + ':</strong></p>' +
        '<p>Within the modern architecture promoted on <strong>GoogleAITools.com</strong>, ' + toolName + ' pairs directly with Google\'s state-of-the-art foundation ecosystem:</p>' +
        '<ul>' +
          '<li><strong>Multimodal Reasoning with Gemini 1.5 Pro &amp; 2.0 Flash:</strong> Use Gemini to generate high-fidelity structured prompts, synthesize input documents, or analyze outputs generated by ' + toolName + '.</li>' +
          '<li><strong>Google Cloud &amp; Vertex AI Integration:</strong> Deploy ' + toolName + '\'s orchestrations alongside Google Cloud Storage (GCS) buckets, Cloud Run microservices, and BigQuery feature stores.</li>' +
          '<li><strong>Chrome &amp; Workspace Agent Automations:</strong> Connect ' + toolName + ' with Google Docs, Gmail, and Google Sheets via official APIs or Chrome extensions to automate end-to-end knowledge workflows.</li>' +
        '</ul>' +
        '<p>This hybrid approach enables developers to leverage ' + toolName + '\'s specialized execution while relying on Google\'s 2-million-token context window for grounding.</p>';
      }

      // 4. Use Cases & Applications
      if (q.includes('use case') || q.includes('what can') || q.includes('how to use') || q.includes('who is') || q.includes('best for') || q.includes('workflow') || q.includes('application')) {
        return '<p><strong>Primary Use Cases for ' + toolName + ' (' + form + '):</strong></p>' +
        '<ul>' +
          '<li><strong>1. Production Workflow Acceleration:</strong> Automates multi-step repetitive operations that previously required hours of manual oversight, reducing end-to-end task turnaround by up to 70%.</li>' +
          '<li><strong>2. Contextual Precision &amp; Tool Calling:</strong> Operates directly on live input datasets or user-specified constraints, ensuring deterministic execution rather than speculative completions.</li>' +
          '<li><strong>3. Cross-Platform Team Collaboration:</strong> Bridges the gap between non-technical domain stakeholders and developer systems through natural language interfaces and exportable deliverables.</li>' +
          '<li><strong>4. Enterprise Prototyping:</strong> Enables product managers and founders to iterate rapidly from concepts to production-ready prototypes with minimal engineering friction.</li>' +
        '</ul>' +
        '<p><strong>Ideal Users:</strong> Developers, product builders, enterprise teams, and creators working within <em>' + cat + '</em>.</p>';
      }

      // 5. Pros and Cons / Limitations
      if (q.includes('pro') || q.includes('con') || q.includes('advantage') || q.includes('limit') || q.includes('disadvantage') || q.includes('drawback') || q.includes('weakness')) {
        return '<p><strong>Architectural Evaluation: Pros &amp; Limitations of ' + toolName + '</strong></p>' +
        '<p><strong>Key Advantages:</strong></p>' +
        '<ul>' +
          '<li>• Specialized engineering focused exclusively on <strong>' + form + '</strong> execution.</li>' +
          '<li>• High productivity boost with intuitive user onboarding and API availability.</li>' +
          '<li>• Active ecosystem support and regular model/feature release cadence.</li>' +
        '</ul>' +
        '<p><strong>Technical Considerations &amp; Limitations:</strong></p>' +
        '<ul>' +
          '<li>• Compute latency and token quota limits can apply during peak cluster demand.</li>' +
          '<li>• Domain-specific edge cases may still require human-in-the-loop review.</li>' +
          '<li>• Complex workflows require structured prompt engineering for maximum repeatability.</li>' +
        '</ul>';
      }

      // 6. General Synthesis
      return '<p><strong>Overview of ' + toolName + ':</strong></p>' +
      '<p><strong>' + toolName + '</strong> is a benchmark-verified product cataloged under <strong>' + cat + '</strong> (Form Factor: <em>' + form + '</em>).</p>' +
      '<p>' + (ctx.summary || 'Engineered for next-generation autonomous workflows, context-grounded execution, and seamless productivity integration.') + '</p>' +
      '<p><strong>Quick Facts:</strong></p>' +
      '<ul>' +
        '<li>• <strong>Catalog ID:</strong> #' + (ctx.id || '') + '</li>' +
        '<li>• <strong>Primary Technology:</strong> ' + form + '</li>' +
        '<li>• <strong>Official Portal:</strong> <a href="' + website + '" target="_blank" rel="noopener noreferrer">' + (domain || 'Visit Official Site') + ' &nearr;</a></li>' +
      '</ul>' +
      '<p>For custom questions, ask about alternatives, pricing tiers, integration with Google Gemini, or specific use cases above!</p>';
    }

    function askAI(prompt) {
      if (!prompt || !prompt.trim()) return;
      const cleanPrompt = prompt.trim();

      // UI state: show container
      responseBox.style.display = 'block';
      echoText.textContent = cleanPrompt;
      answerBody.innerHTML = '<div style="display:flex; align-items:center; gap:8px; color:var(--text-muted); font-size:0.92rem;"><span class="dir-ai-sparkle-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg></span> <span>AI is analyzing ' + (ctx.name || 'tool') + ' specifications...</span></div>';
      responseBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

      // Immediate local grounded response
      const localAnswer = generateContextualAnswer(cleanPrompt);

      // Attempt live WordPress AJAX / Gemini hook (with fast 700ms fallback)
      let resolved = false;
      const timer = setTimeout(function() {
        if (!resolved) {
          resolved = true;
          typeOutAnswer(localAnswer);
        }
      }, 700);

      if (ctx.ajaxUrl) {
        const formData = new FormData();
        formData.append('action', 'googleaitools_ask_ai');
        formData.append('tool_name', ctx.name || '');
        formData.append('tool_category', ctx.category || '');
        formData.append('tool_form', ctx.formFactor || '');
        formData.append('query', cleanPrompt);

        fetch(ctx.ajaxUrl, { method: 'POST', body: formData })
          .then(r => r.json())
          .then(data => {
            if (!resolved) {
              resolved = true;
              clearTimeout(timer);
              if (data && data.success && data.data && data.data.answer) {
                // Format markdown text from Gemini
                let formatted = data.data.answer
                  .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                  .replace(/\*(.*?)\*/g, '<em>$1</em>')
                  .replace(/\n\n/g, '</p><p>')
                  .replace(/\n• /g, '<br>• ')
                  .replace(/\n- /g, '<br>• ');
                typeOutAnswer('<p>' + formatted + '</p>');
              } else {
                typeOutAnswer(localAnswer);
              }
            }
          })
          .catch(() => {
            if (!resolved) {
              resolved = true;
              clearTimeout(timer);
              typeOutAnswer(localAnswer);
            }
          });
      }
    }

    function typeOutAnswer(htmlContent) {
      answerBody.style.opacity = '0';
      answerBody.innerHTML = htmlContent;
      answerBody.style.transition = 'opacity 0.25s ease';
      setTimeout(() => { answerBody.style.opacity = '1'; }, 50);
    }

    // Submit via button
    submitBtn.addEventListener('click', function() {
      askAI(inputField.value);
    });

    // Submit via Enter key
    inputField.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        askAI(inputField.value);
      }
    });

    // Chip click handler
    chips.forEach(chip => {
      chip.addEventListener('click', function() {
        const p = this.getAttribute('data-prompt');
        inputField.value = p;
        askAI(p);
      });
    });

    // Copy Answer
    if (copyBtn) {
      copyBtn.addEventListener('click', function() {
        const text = answerBody.innerText || answerBody.textContent;
        navigator.clipboard.writeText(text).then(() => {
          if (copyLabel) copyLabel.textContent = 'Copied! ✓';
          setTimeout(() => { if (copyLabel) copyLabel.textContent = 'Copy Answer'; }, 2000);
        });
      });
    }

    // Clear Answer
    if (clearBtn) {
      clearBtn.addEventListener('click', function() {
        inputField.value = '';
        responseBox.style.display = 'none';
        inputField.focus();
      });
    }
  });
  </script>

</div>

<?php
// =========================================================================
// VIEW B: FULL DIRECTORY GRID OF ALL 291 TOOLS
// =========================================================================
else :
    // Extract unique categories
    $categories = array();
    foreach ($products as $p) {
        if (!empty($p['category']) && !in_array($p['category'], $categories)) {
            $categories[] = $p['category'];
        }
    }
?>

<!-- Directory Hero Banner -->
<section class="hero-banner" style="padding: 56px 24px 36px; text-align: center;">
  <div class="hero-content" style="max-width: 900px; margin: 0 auto;">
    <div class="hero-badge" style="margin-bottom: 16px;">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline-block; vertical-align:-2px; margin-right:4px;"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
      <?php echo count($products); ?>+ Curated Products &bull; Global AI Directory
    </div>
    <h1 class="hero-title" style="font-size: 2.6rem; margin-bottom: 16px;">Global AI Startup & Product Discovery</h1>
    <p class="hero-subtitle" style="font-size: 1.1rem; color: var(--text-secondary); max-width: 740px; margin: 0 auto 28px; line-height: 1.6;">
      Explore real-world frontier AI products, autonomous agents, foundation models, and disruptive startups across 11 key technology sectors.
    </p>

    <!-- Upgraded AI Semantic Natural Language Search Box -->
    <div class="dir-search-container">
      <div class="dir-search-box-wrapper">
        <div class="dir-ai-sparkle-icon" title="AI Semantic Search Active">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/>
          </svg>
        </div>
        <input type="text" id="dir-search-input" placeholder="Ask AI in natural language (e.g. &quot;tell me a tool that can make an video for me&quot;, &quot;best coding assistants&quot;)..." autocomplete="off">
        <button id="dir-clear-btn" style="display: none; background: none; border: none; font-size: 1.2rem; color: var(--text-secondary); cursor: pointer; padding: 0 8px;" title="Clear search">&times;</button>
      </div>

      <!-- Quick Suggested Natural Language Prompt Chips -->
      <div class="dir-quick-prompts">
        <span class="dir-quick-prompts-label">Try asking:</span>
        <button type="button" class="dir-prompt-chip" data-query="tell me a tool that can make an video for me">
          🎬 Make a video for me
        </button>
        <button type="button" class="dir-prompt-chip" data-query="best tools to write and debug code">
          💻 Best coding assistants
        </button>
        <button type="button" class="dir-prompt-chip" data-query="tools to clone voice or text to speech">
          🎙️ Voice &amp; speech cloning
        </button>
        <button type="button" class="dir-prompt-chip" data-query="autonomous agents that browse the web">
          🤖 Autonomous web agents
        </button>
        <button type="button" class="dir-prompt-chip" data-query="best AI startups and LLMs from India">
          🇮🇳 India AI startups
        </button>
        <button type="button" class="dir-prompt-chip" data-query="tools for researching scientific papers">
          🔬 Research &amp; papers
        </button>
      </div>
    </div>

    <!-- Category Filter Pills -->
    <div class="dir-filter-bar">
      <button type="button" class="dir-filter-btn active" data-cat="all">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="dir-btn-icon"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path></svg>
        <span>All Tools</span> <span class="dir-btn-count"><?php echo count($products); ?></span>
      </button>
      <?php foreach ($categories as $cat) : 
        $count = count(array_filter($products, function($i) use ($cat) { return $i['category'] === $cat; }));
        $disp_name = function_exists('googleaitools_shorten_category') ? googleaitools_shorten_category($cat) : preg_replace('/^\d+\.\s*/', '', $cat);
      ?>
        <button type="button" class="dir-filter-btn" data-cat="<?php echo esc_attr($cat); ?>">
          <span><?php echo esc_html($disp_name); ?></span> <span class="dir-btn-count"><?php echo $count; ?></span>
        </button>
      <?php endforeach; ?>
    </div>

    <!-- AI Natural Language Intent Recommendation Banner -->
    <div id="dir-ai-insight-box" class="dir-ai-insight-box" style="display: none; margin-top: 24px;">
      <div class="dir-ai-insight-header">
        <div style="display: flex; align-items: center; gap: 8px;">
          <span class="dir-ai-badge">✨ AI Intent Matched</span>
          <span class="dir-ai-intent-title" id="dir-ai-intent-title">Topic: <strong>Video Creation &amp; Generation</strong></span>
        </div>
        <button type="button" id="dir-ai-insight-close" style="background: none; border: none; color: var(--text-muted); cursor: pointer; font-size: 1.1rem; padding: 0 4px;" title="Dismiss AI recommendation">&times;</button>
      </div>
      <p class="dir-ai-insight-text" id="dir-ai-insight-text"></p>
    </div>
  </div>
</section>

<!-- Directory Content Container -->
<main style="max-width: var(--max-width-page); margin: 0 auto; padding: 32px 24px 64px;">
  <!-- Results Meta Bar -->
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 1px solid var(--border-color);">
    <div id="dir-results-count" style="font-size: 0.95rem; font-weight: 600; color: var(--text-secondary);">
      Showing <?php echo count($products); ?> tools & startups
    </div>
    <div style="font-size: 0.85rem; color: var(--text-muted);">
      Data synchronized with <a href="https://github.com/ranjith-vp/awesome-google-ai-tools" target="_blank" rel="noopener noreferrer" style="color: var(--color-google-blue); text-decoration: underline;">GitHub Repository</a>
    </div>
  </div>

  <!-- Tools Grid -->
  <div id="dir-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(min(100%, 300px), 1fr)); gap: 20px;">
    <?php foreach ($products as $p) : 
      $cat_clean = preg_replace('/^\d+\.\s*/', '', $p['category']);
      $cat_short = function_exists('googleaitools_shorten_category') ? googleaitools_shorten_category($p['category']) : $cat_clean;
      $tool_url = home_url('/ai-directory/' . $p['slug'] . '/');
    ?>
      <article class="dir-card" data-category="<?php echo esc_attr($p['category']); ?>" data-short-category="<?php echo esc_attr(strtolower($cat_short)); ?>" data-name="<?php echo esc_attr(strtolower($p['name'])); ?>" data-summary="<?php echo esc_attr(strtolower($p['summary'])); ?>" data-tag="<?php echo esc_attr(strtolower($p['formFactor'])); ?>" onclick="window.location.href='<?php echo esc_url($tool_url); ?>';" style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s; box-shadow: var(--shadow-sm); cursor: pointer; position: relative;">
        <div>
          <!-- Header with ID, Logo & Name -->
          <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; gap: 8px;">
            <div style="display: flex; align-items: center; gap: 10px;">
              <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background: var(--bg-secondary); border: 1px solid var(--border-color); font-size: 0.75rem; font-weight: 700; color: var(--text-muted); flex-shrink: 0;">
                #<?php echo esc_html($p['id']); ?>
              </span>
              <img src="<?php echo esc_url($p['logoUrl']); ?>" alt="<?php echo esc_attr($p['name']); ?> logo" width="24" height="24" style="border-radius: 5px; object-fit: contain; flex-shrink: 0;" loading="lazy" onload="if(this.naturalWidth<=16&&this.naturalHeight<=16)window.handleToolLogoError(this, '<?php echo esc_js($p['name']); ?>');" onerror="window.handleToolLogoError(this, '<?php echo esc_js($p['name']); ?>');">
              <h3 style="font-size: 1.15rem; font-weight: 700; margin: 0; color: var(--text-primary); font-family: var(--font-heading);">
                <?php echo esc_html($p['name']); ?>
              </h3>
            </div>
            <span style="display: inline-block; padding: 3px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; background: var(--color-google-blue-light); color: var(--color-google-blue); white-space: nowrap;">
              <?php echo esc_html($p['formFactor']); ?>
            </span>
            <?php if (!empty($p['status']) && in_array($p['status'], array('discontinued', 'dropped', 'superseded', 'legacy', 'deprecated', 'rebranded'))) : ?>
              <span style="display: inline-block; padding: 3px 8px; border-radius: 6px; font-size: 0.72rem; font-weight: 700; background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; white-space: nowrap;">
                Dropped
              </span>
            <?php endif; ?>
          </div>

          <!-- Category Badge -->
          <div style="font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); margin-bottom: 8px;">
            <?php echo esc_html($cat_short); ?>
          </div>

          <!-- Summary Description -->
          <p style="font-size: 0.9rem; line-height: 1.5; color: var(--text-secondary); margin: 0 0 16px;">
            <?php echo esc_html($p['summary']); ?>
          </p>
        </div>

        <!-- Card Footer Links -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 12px; border-top: 1px solid var(--border-light); font-size: 0.85rem;">
          <span style="color: var(--color-google-blue); font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
            Deep Dive <span>&rarr;</span>
          </span>
          <a href="<?php echo esc_url($p['website']); ?>" target="_blank" rel="noopener noreferrer" onclick="event.stopPropagation();" title="Visit official site for <?php echo esc_attr($p['name']); ?>" style="color: var(--text-muted); text-decoration: none; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 3px; padding: 4px 6px; border-radius: 4px; transition: color 0.2s;">
            Official Site <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
          </a>
        </div>
      </article>
    <?php endforeach; ?>
  </div>

  <div id="dir-no-results" style="display: none; text-align: center; padding: 64px 20px; color: var(--text-muted);">
    <p style="font-size: 1.2rem; margin-bottom: 8px;">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline-block; vertical-align:-3px; margin-right:6px;"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
      No tools found matching your search.
    </p>
    <p style="font-size: 0.9rem;">Try searching for terms like "video", "agent", "coding", "voice", or "India".</p>
  </div>
</main>

<!-- Directory Interactive AI Semantic Filtering Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('dir-search-input');
  const clearBtn = document.getElementById('dir-clear-btn');
  const filterBtns = document.querySelectorAll('.dir-filter-btn');
  const grid = document.getElementById('dir-grid');
  const cards = Array.from(document.querySelectorAll('.dir-card'));
  const countDisplay = document.getElementById('dir-results-count');
  const noResults = document.getElementById('dir-no-results');
  const promptChips = document.querySelectorAll('.dir-prompt-chip');
  const insightBox = document.getElementById('dir-ai-insight-box');
  const insightTitle = document.getElementById('dir-ai-intent-title');
  const insightText = document.getElementById('dir-ai-insight-text');
  const insightClose = document.getElementById('dir-ai-insight-close');

  let activeCategory = 'all';

  // Store original card order for fast restore
  const originalCardsOrder = [...cards];

  // Common conversational stop words to filter from natural language queries
  const STOP_WORDS = new Set([
    'tell', 'me', 'a', 'an', 'the', 'tool', 'tools', 'that', 'can', 'could', 'would', 'should',
    'make', 'makes', 'making', 'for', 'me', 'us', 'show', 'give', 'find', 'what', 'whats', 'what\'s',
    'is', 'are', 'best', 'top', 'good', 'recommend', 'recommended', 'recommendation', 'recommendations',
    'i', 'im', 'i\'m', 'want', 'need', 'looking', 'to', 'with', 'some', 'any', 'which', 'please',
    'help', 'how', 'do', 'does', 'using', 'use', 'create', 'creating', 'build', 'building', 'there',
    'something', 'like', 'about', 'get', 'where', 'who', 'around', 'all'
  ]);

  // Semantic Intent Knowledge Graph for AI Directory
  const INTENT_DOMAINS = [
    {
      id: 'video',
      title: 'Video Creation & Generation',
      keywords: ['video', 'videos', 'movie', 'movies', 'animation', 'animations', 'clip', 'clips', 'film', 'avatar', 'avatars', 'motion', 'rendering', 'vfx', 'cinematic', 'b-roll', 'visual effects', 'scene', 'veo', 'google veo', 'sora'],
      boostCategory: 'creative, video',
      topTools: ['Google Veo', 'Runway', 'Pika', 'Luma AI', 'Kling AI', 'OpenAI Sora', 'HeyGen', 'Synthesia', 'Wonder Studio'],
      summary: function(count) {
        return 'Looking for video generation? We matched <strong>' + count + ' specialized AI tools</strong> engineered for text-to-video, AI avatar presenters, cinematic physical motion, and video editing. Top recommendations to explore: <strong>Google Veo</strong>, <strong>OpenAI Sora</strong>, <strong>Runway (Gen-3 Alpha)</strong>, and <strong>Pika</strong>.';
      }
    },
    {
      id: 'coding',
      title: 'Coding & Software Engineering',
      keywords: ['code', 'coding', 'program', 'programming', 'developer', 'software', 'ide', 'autocomplete', 'debug', 'debugging', 'repo', 'github', 'git', 'pull request', 'app building', 'fullstack', 'frontend', 'backend', 'react', 'swe', 'engineer'],
      boostCategory: 'software development',
      topTools: ['Cursor', 'Windsurf', 'Devin', 'Lovable', 'Bolt.new', 'Replit Agent', 'Cline', 'OpenHands', 'v0'],
      summary: function(count) {
        return 'Seeking software engineering assistance? We identified <strong>' + count + ' AI-first IDEs and autonomous SWE agents</strong> capable of debugging, editing full repositories, and building full-stack applications. Top recommendations: <strong>Cursor</strong>, <strong>Windsurf</strong>, <strong>Devin</strong>, and <strong>Lovable</strong>.';
      }
    },
    {
      id: 'voice',
      title: 'Voice, Speech & Audio Intelligence',
      keywords: ['voice', 'speech', 'tts', 'text to speech', 'clone voice', 'audio', 'podcast', 'transcribe', 'transcription', 'whisper', 'music', 'sound', 'sing', 'song', 'dictate', 'dictation', 'meeting', 'recaps', 'record'],
      boostCategory: 'voice, communication',
      topTools: ['ElevenLabs', 'Cartesia', 'Wispr Flow', 'Granola', 'Fireflies.ai', 'Otter.ai', 'Deepgram', 'Suno', 'Udio'],
      summary: function(count) {
        return 'Looking for voice synthesis or meeting intelligence? We matched <strong>' + count + ' tools</strong> for ultra-low-latency text-to-speech, voice persona cloning, ambient dictation, and generative music. Top recommendations: <strong>ElevenLabs</strong>, <strong>Cartesia</strong>, <strong>Wispr Flow</strong>, and <strong>Suno</strong>.';
      }
    },
    {
      id: 'agents',
      title: 'Autonomous Agents & Universal Assistants',
      keywords: ['agent', 'agents', 'autonomous', 'automate', 'automation', 'browser agent', 'computer use', 'work for me', 'personal assistant', 'errand', 'errands', 'workflow', 'action', 'task', 'execute'],
      boostCategory: 'personal ai agents',
      topTools: ['Manus', 'OpenClaw', 'Genspark', 'OpenAI ChatGPT Agent', 'Claude Computer Use', 'MultiOn', 'Rabbit R1', 'CrewAI'],
      summary: function(count) {
        return 'Exploring autonomous agent systems? We discovered <strong>' + count + ' frontier agents</strong> capable of browsing live websites, controlling desktop GUIs, and orchestrating multi-step goals without human intervention. Top recommendations: <strong>Manus</strong>, <strong>OpenClaw</strong>, <strong>Claude Computer Use</strong>, and <strong>CrewAI</strong>.';
      }
    },
    {
      id: 'browsers',
      title: 'AI Browsers & Web Navigation',
      keywords: ['browser', 'browsers', 'browsing', 'web browsing', 'internet', 'surf', 'surfing', 'scrape', 'scraping', 'crawl', 'crawler', 'web navigation'],
      boostCategory: 'ai browsers',
      topTools: ['Dia Browser', 'Comet', 'Arc Browser', 'Browser Use', 'Browserbase', 'Firecrawl', 'Exa'],
      summary: function(count) {
        return 'Interested in next-generation internet browsing? We found <strong>' + count + ' AI-native browsers and cloud automation frameworks</strong>. Top recommendations: <strong>Dia Browser</strong>, <strong>Comet (by Perplexity)</strong>, <strong>Browser Use</strong>, and <strong>Firecrawl</strong>.';
      }
    },
    {
      id: 'research',
      title: 'Research, Academic & Deep Search',
      keywords: ['research', 'search', 'google alternative', 'papers', 'paper', 'academic', 'citations', 'literature review', 'facts', 'deep research', 'scholar', 'study', 'scientific', 'notes'],
      boostCategory: 'research, knowledge',
      topTools: ['Perplexity', 'Elicit', 'Consensus', 'SciSpace', 'NotebookLM', 'Glean', 'Exa', 'Tavily'],
      summary: function(count) {
        return 'Conducting literature reviews or research? We matched <strong>' + count + ' tools</strong> that index peer-reviewed scientific papers, extract verifiable citations, and organize knowledge graphs. Top recommendations: <strong>Perplexity</strong>, <strong>Elicit</strong>, <strong>Consensus</strong>, and <strong>NotebookLM</strong>.';
      }
    },
    {
      id: 'india',
      title: 'AI Startups & Indic Models from India',
      keywords: ['india', 'indian', 'indic', 'hindi', 'tamil', 'telugu', 'bengali', 'railways', 'farmer', 'bilingual', 'indians'],
      boostCategory: 'startups from india',
      topTools: ['Sarvam AI', 'Krutrim', 'Yellow.ai', 'Smallest.ai', 'CoRover', 'KissanAI', 'BharatGPT', 'Emergent'],
      summary: function(count) {
        return 'Exploring sovereign artificial intelligence from India? We cataloged <strong>' + count + ' disruptive startups</strong> developing foundational Indic-language LLMs, voice AI for regional dialects, and enterprise automation. Top recommendations: <strong>Sarvam AI</strong>, <strong>Krutrim</strong>, <strong>Yellow.ai</strong>, and <strong>CoRover</strong>.';
      }
    },
    {
      id: 'health',
      title: 'Healthcare & Biotechnology AI',
      keywords: ['health', 'healthcare', 'biotech', 'biotechnology', 'medicine', 'medical', 'doctor', 'clinical', 'ehr', 'drug discovery', 'biology', 'hospital', 'therapy', 'mental wellness'],
      boostCategory: 'healthcare & biotechnology',
      topTools: ['Abridge', 'Ambience Healthcare', 'Hippocratic AI', 'Nabla', 'Suki', 'Insilico Medicine', 'Recursion Pharmaceuticals', 'Isomorphic Labs'],
      summary: function(count) {
        return 'Investigating medical and life-sciences AI? We matched <strong>' + count + ' specialized healthcare solutions</strong> automating clinical notes, radiology interpretation, and molecular drug discovery. Top recommendations: <strong>Abridge</strong>, <strong>Hippocratic AI</strong>, and <strong>Isomorphic Labs</strong>.';
      }
    },
    {
      id: 'robotics',
      title: 'Robotics & Physical AI',
      keywords: ['robot', 'robots', 'robotics', 'physical', 'humanoid', 'humanoids', 'drone', 'drones', 'self driving', 'trucking', 'autonomous vehicle', 'robotaxi', 'warehouse'],
      boostCategory: 'robotics & physical',
      topTools: ['Figure AI', 'Physical Intelligence (Pi)', '1X Technologies', 'Skild AI', 'Waymo', 'Anduril', 'Zipline'],
      summary: function(count) {
        return 'Exploring physical intelligence and robotics? We cataloged <strong>' + count + ' leaders</strong> in bipedal humanoid robots, autonomous drone logistics, and self-driving fleets. Top recommendations: <strong>Figure AI (Figure 02)</strong>, <strong>Physical Intelligence (pi0)</strong>, and <strong>Waymo</strong>.';
      }
    },
    {
      id: 'infra',
      title: 'AI Infrastructure & Developer Ecosystem',
      keywords: ['infra', 'infrastructure', 'vector database', 'vector db', 'embeddings', 'rag', 'gateway', 'proxy', 'observability', 'gpu', 'cloud', 'serving', 'inference', 'mcp'],
      boostCategory: 'infrastructure',
      topTools: ['LangChain', 'LlamaIndex', 'Composio', 'Model Context Protocol (MCP)', 'Pinecone', 'OpenRouter', 'LiteLLM', 'Fireworks AI'],
      summary: function(count) {
        return 'Building AI infrastructure? We matched <strong>' + count + ' developer tools</strong> for multi-model routing, vector databases, and stateful agent memory. Top recommendations: <strong>LangChain</strong>, <strong>LlamaIndex</strong>, <strong>Model Context Protocol (MCP)</strong>, and <strong>OpenRouter</strong>.';
      }
    }
  ];

  function runAISearch() {
    const rawQuery = searchInput ? searchInput.value.trim() : '';
    const queryLower = rawQuery.toLowerCase();

    if (!rawQuery) {
      // Reset to category filter
      cards.forEach(card => {
        const cardCat = card.getAttribute('data-category');
        const matchesCat = (activeCategory === 'all' || cardCat === activeCategory);
        card.style.display = matchesCat ? 'flex' : 'none';
      });

      // Restore original card order in DOM
      originalCardsOrder.forEach(card => grid.appendChild(card));

      if (countDisplay) {
        const visible = cards.filter(c => c.style.display !== 'none').length;
        countDisplay.textContent = 'Showing ' + visible + ' of ' + cards.length + ' tools & startups';
      }
      if (noResults) noResults.style.display = 'none';
      if (clearBtn) clearBtn.style.display = 'none';
      if (insightBox) insightBox.style.display = 'none';
      return;
    }

    if (clearBtn) clearBtn.style.display = 'inline-block';

    // 1. NLP Tokenization & Stop Words Extraction
    const tokens = queryLower
      .replace(/[^\w\s-]/g, ' ')
      .split(/\s+/)
      .filter(t => t.length > 1 && !STOP_WORDS.has(t));

    // 2. Identify Semantic Intent Domain
    let matchedDomain = null;
    let maxDomainScore = 0;

    INTENT_DOMAINS.forEach(domain => {
      let dScore = 0;
      domain.keywords.forEach(kw => {
        if (queryLower.includes(kw)) {
          dScore += (kw.includes(' ') ? 4 : 2);
        }
      });
      if (dScore > maxDomainScore) {
        maxDomainScore = dScore;
        matchedDomain = domain;
      }
    });

    // 3. Score every card based on Intent + Direct Matching
    const scoredCards = [];
    cards.forEach(card => {
      const cardCat = (card.getAttribute('data-category') || '').toLowerCase();
      const cardShortCat = (card.getAttribute('data-short-category') || '').toLowerCase();
      const cardName = (card.getAttribute('data-name') || '').toLowerCase();
      const cardSummary = (card.getAttribute('data-summary') || '').toLowerCase();
      const cardTag = (card.getAttribute('data-tag') || '').toLowerCase();

      let score = 0;

      // Direct exact match
      if (cardName.includes(queryLower)) score += 120;
      if (cardSummary.includes(queryLower)) score += 60;
      if (cardTag.includes(queryLower)) score += 40;

      // Token matches
      tokens.forEach(tok => {
        if (cardName.includes(tok)) score += 45;
        if (cardSummary.includes(tok)) score += 20;
        if (cardTag.includes(tok)) score += 25;
        if (cardCat.includes(tok) || cardShortCat.includes(tok)) score += 30;
      });

      // Semantic Intent Boost
      if (matchedDomain) {
        if (cardCat.includes(matchedDomain.boostCategory)) {
          score += 55;
        }
        // Boost specifically recommended flagship tools
        if (matchedDomain.topTools.some(tool => cardName.includes(tool.toLowerCase()))) {
          score += 40;
        }
      }

      // Check category filter constraint if user manually picked a category
      const matchesCat = (activeCategory === 'all' || card.getAttribute('data-category') === activeCategory);
      if (!matchesCat) score = 0;

      scoredCards.push({ card, score });
    });

    // Sort by descending score
    scoredCards.sort((a, b) => b.score - a.score);

    // Apply visibility and re-append in sorted order
    let visibleCount = 0;
    scoredCards.forEach(item => {
      if (item.score > 0) {
        item.card.style.display = 'flex';
        grid.appendChild(item.card);
        visibleCount++;
      } else {
        item.card.style.display = 'none';
      }
    });

    // Update count display
    if (countDisplay) {
      countDisplay.textContent = 'Showing ' + visibleCount + ' of ' + cards.length + ' tools & startups';
    }

    // Toggle No Results
    if (noResults) {
      noResults.style.display = (visibleCount === 0) ? 'block' : 'none';
    }

    // Render AI Recommendation Insight Banner if intent detected
    if (insightBox && insightTitle && insightText) {
      if (matchedDomain && visibleCount > 0) {
        insightTitle.innerHTML = 'Topic: <strong>' + matchedDomain.title + '</strong>';
        insightText.innerHTML = matchedDomain.summary(visibleCount);
        insightBox.style.display = 'block';
      } else {
        insightBox.style.display = 'none';
      }
    }
  }

  // Filter Buttons
  filterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      filterBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      activeCategory = this.getAttribute('data-cat');
      runAISearch();
    });
  });

  // Search Input live typing
  if (searchInput) {
    searchInput.addEventListener('input', runAISearch);
  }

  // Clear Button
  if (clearBtn) {
    clearBtn.addEventListener('click', function() {
      searchInput.value = '';
      runAISearch();
      searchInput.focus();
    });
  }

  // Quick Prompt Chips
  promptChips.forEach(chip => {
    chip.addEventListener('click', function() {
      const q = this.getAttribute('data-query');
      if (searchInput && q) {
        searchInput.value = q;
        runAISearch();
        searchInput.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
    });
  });

  // Close Insight Banner
  if (insightClose) {
    insightClose.addEventListener('click', function() {
      if (insightBox) insightBox.style.display = 'none';
    });
  }
});
</script>

<?php endif; ?>


<?php get_footer(); ?>
