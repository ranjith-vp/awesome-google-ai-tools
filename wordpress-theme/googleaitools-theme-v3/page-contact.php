<?php
/**
 * Template Name: Contact Us
 * Description: Dedicated contact page featuring official email contact@googleaitools.com, inquiry routing, and SLA guidelines.
 */

get_header();
?>

<header class="article-header" style="background: var(--bg-secondary); border-bottom: 1px solid var(--border-color); padding: 56px 24px 40px; text-align: center;">
  <div style="max-width: 800px; margin: 0 auto;">
    <nav class="breadcrumb" style="margin-bottom: 16px; font-size: 0.9rem; color: var(--text-muted); display: flex; justify-content: center; align-items: center; gap: 8px;">
      <a href="<?php echo esc_url(home_url('/')); ?>" style="color: var(--text-muted); text-decoration: none;">Home</a>
      <span>/</span>
      <span style="color: var(--color-google-blue); font-weight: 600;">Contact Us</span>
    </nav>
    
    <div style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 20px; font-size: 0.82rem; font-weight: 700; background: var(--color-google-blue-light); color: var(--color-google-blue); margin-bottom: 16px;">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
      Official Communications Channel
    </div>

    <h1 style="font-family: var(--font-heading); font-size: clamp(2rem, 4vw, 2.75rem); font-weight: 800; margin: 0 0 16px; color: var(--text-primary); line-height: 1.2;">
      Get in Touch with Our Team
    </h1>
    <p style="font-size: 1.1rem; color: var(--text-secondary); line-height: 1.6; max-width: 660px; margin: 0 auto;">
      Have a question regarding our AI guides, spotted an outdated benchmark, want to submit an AI model or startup, or need editorial assistance? Reach out to us directly.
    </p>
  </div>
</header>

<main style="max-width: 900px; margin: 0 auto; padding: 40px 24px 80px;">

  <!-- Primary Email Box -->
  <div style="background: var(--bg-primary); border: 2px solid var(--border-color); border-radius: 16px; padding: clamp(24px, 4vw, 36px); box-shadow: var(--shadow-sm); margin-bottom: 40px; text-align: center; position: relative;">
    <div style="display: inline-flex; align-items: center; justify-content: center; width: 54px; height: 54px; border-radius: 50%; background: var(--color-google-blue-light); color: var(--color-google-blue); margin-bottom: 16px;">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
    </div>

    <h2 style="font-family: var(--font-heading); font-size: 1.35rem; font-weight: 700; margin: 0 0 8px; color: var(--text-primary);">
      Official Editorial & Support Email
    </h2>
    <p style="font-size: 0.95rem; color: var(--text-secondary); margin: 0 0 20px;">
      Direct point of contact for all inquiries, corrections, and partnerships.
    </p>

    <div style="display: inline-flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 12px; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; padding: 12px 24px; margin-bottom: 24px;">
      <span id="official-email-text" style="font-family: 'Fira Code', monospace, sans-serif; font-size: 1.15rem; font-weight: 700; color: var(--color-google-blue); letter-spacing: 0.5px;">
        contact@googleaitools.com
      </span>
      <button id="copy-email-btn" onclick="copyEmailToClipboard()" type="button" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; cursor: pointer; border: 1px solid var(--border-color); background: var(--bg-primary); color: var(--text-primary); transition: all 0.2s;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
        <span id="copy-btn-label">Copy Email</span>
      </button>
    </div>

    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 12px;">
      <a href="mailto:contact@googleaitools.com?subject=Inquiry%20via%20GoogleAITools.com" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 8px; font-size: 0.95rem; font-weight: 600; text-decoration: none; background: var(--color-google-blue); color: #ffffff; transition: background 0.2s; box-shadow: var(--shadow-sm);">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
        Send an Email
      </a>
    </div>

    <div style="margin-top: 20px; font-size: 0.85rem; color: var(--text-muted); display: flex; align-items: center; justify-content: center; gap: 6px;">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
      Average response time: 24 to 48 business hours
    </div>
  </div>

  <!-- Inquiry Categories Grid -->
  <h3 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 700; margin: 0 0 20px; color: var(--text-primary); text-align: center;">
    How Can We Help You?
  </h3>

  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 260px), 1fr)); gap: 18px; margin-bottom: 40px;">
    
    <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px; box-shadow: var(--shadow-sm);">
      <div style="font-size: 1.5rem; margin-bottom: 8px;">✍️</div>
      <h4 style="font-family: var(--font-heading); font-size: 1rem; font-weight: 700; margin: 0 0 6px; color: var(--text-primary);">
        Editorial & Corrections
      </h4>
      <p style="font-size: 0.88rem; color: var(--text-secondary); line-height: 1.5; margin: 0 0 12px;">
        Spotted a changed API flag, outdated benchmark, or technical error? Let our editorial staff know.
      </p>
      <a href="mailto:contact@googleaitools.com?subject=Editorial%20Correction" style="font-size: 0.85rem; font-weight: 600; color: var(--color-google-blue); text-decoration: none;">
        Submit Correction &rarr;
      </a>
    </div>

    <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px; box-shadow: var(--shadow-sm);">
      <div style="font-size: 1.5rem; margin-bottom: 8px;">🚀</div>
      <h4 style="font-family: var(--font-heading); font-size: 1rem; font-weight: 700; margin: 0 0 6px; color: var(--text-primary);">
        Tool & Model Submissions
      </h4>
      <p style="font-size: 0.88rem; color: var(--text-secondary); line-height: 1.5; margin: 0 0 12px;">
        Building an AI product, LLM framework, or developer tool? Request listing consideration in our directory.
      </p>
      <a href="mailto:contact@googleaitools.com?subject=New%20Tool%20Submission" style="font-size: 0.85rem; font-weight: 600; color: var(--color-google-blue); text-decoration: none;">
        Submit AI Tool &rarr;
      </a>
    </div>

    <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px; box-shadow: var(--shadow-sm);">
      <div style="font-size: 1.5rem; margin-bottom: 8px;">⚖️</div>
      <h4 style="font-family: var(--font-heading); font-size: 1rem; font-weight: 700; margin: 0 0 6px; color: var(--text-primary);">
        DMCA & Legal Notices
      </h4>
      <p style="font-size: 0.88rem; color: var(--text-secondary); line-height: 1.5; margin: 0 0 12px;">
        Copyright takedowns, trademark owner notices, or terms of use inquiries are prioritized by our legal agent.
      </p>
      <a href="mailto:contact@googleaitools.com?subject=DMCA%20or%20Legal%20Notice" style="font-size: 0.85rem; font-weight: 600; color: var(--color-google-blue); text-decoration: none;">
        Send Legal Notice &rarr;
      </a>
    </div>

    <div style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px; box-shadow: var(--shadow-sm);">
      <div style="font-size: 1.5rem; margin-bottom: 8px;">🔒</div>
      <h4 style="font-family: var(--font-heading); font-size: 1rem; font-weight: 700; margin: 0 0 6px; color: var(--text-primary);">
        Privacy & Compliance
      </h4>
      <p style="font-size: 0.88rem; color: var(--text-secondary); line-height: 1.5; margin: 0 0 12px;">
        Questions concerning DPDP (India), GDPR (Europe), or CCPA compliance? Reach our data privacy officer.
      </p>
      <a href="mailto:contact@googleaitools.com?subject=Privacy%20Inquiry" style="font-size: 0.85rem; font-weight: 600; color: var(--color-google-blue); text-decoration: none;">
        Contact Privacy Officer &rarr;
      </a>
    </div>

  </div>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php if (get_the_content()) : ?>
    <div class="article-content" style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px; margin-top: 32px;">
      <?php the_content(); ?>
    </div>
    <?php endif; ?>
  <?php endwhile; endif; ?>

</main>

<script>
function copyEmailToClipboard() {
  const email = "contact@googleaitools.com";
  const btn = document.getElementById('copy-email-btn');
  const label = document.getElementById('copy-btn-label');
  
  navigator.clipboard.writeText(email).then(() => {
    label.textContent = "Copied!";
    btn.style.borderColor = "#10b981";
    btn.style.color = "#10b981";
    setTimeout(() => {
      label.textContent = "Copy Email";
      btn.style.borderColor = "var(--border-color)";
      btn.style.color = "var(--text-primary)";
    }, 2000);
  }).catch(() => {
    window.location.href = "mailto:" + email;
  });
}
</script>

<?php get_footer(); ?>
