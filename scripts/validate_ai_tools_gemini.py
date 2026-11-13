#!/usr/bin/env python3
"""
=============================================================================
Google AI Tools Directory - Gemini Content & On-Page SEO Validator
=============================================================================
Audits and validates the content of AI tool pages one-by-one using Google Gemini API.

Evaluation Criteria (Strict 4-Pillar Validation):
1. Informative & Human-Written Depth:
   - High editorial value, clear architectural mechanics, zero boilerplate.
2. On-Page SEO (200% Quality Standard):
   - Title, H1/H2 hierarchy, meta description, clean URL slug, schema suitability.
3. On-Page Technical & Architecture Completeness:
   - Form factor precision, domain validity, category alignment.
4. 500% Uniqueness & Zero Plagiarism Risk:
   - Distinct technical value proposition, original phrasing, high utility.

Usage:
  python validate_ai_tools_gemini.py --api-key YOUR_GEMINI_KEY --limit 5
  python validate_ai_tools_gemini.py --tool devin
  python validate_ai_tools_gemini.py --all --output audit_report.md
=============================================================================
"""

import os
import sys
import json
import time
import argparse
import urllib.request
import urllib.error
from typing import Dict, Any, List, Optional

# Default paths
SCRIPT_DIR = os.path.dirname(os.path.abspath(__file__))
DATA_FILE_CANDIDATES = [
    os.path.join(SCRIPT_DIR, "assets", "data", "global-ai-products.json"),
    os.path.join(SCRIPT_DIR, "data", "global-ai-products.json"),
    os.path.join(SCRIPT_DIR, "googleaitools-website", "wordpress-theme", "googleaitools-theme", "assets", "data", "global-ai-products.json"),
    os.path.join(SCRIPT_DIR, "scratch", "googleaitools-website", "wordpress-theme", "googleaitools-theme", "assets", "data", "global-ai-products.json"),
    "C:/Users/ZBOOK/.gemini/antigravity/scratch/googleaitools-website/wordpress-theme/googleaitools-theme/assets/data/global-ai-products.json"
]

def find_data_file() -> str:
    for candidate in DATA_FILE_CANDIDATES:
        if os.path.exists(candidate):
            return candidate
    raise FileNotFoundError("Could not locate global-ai-products.json. Please specify path via --data.")

def load_products(path: str) -> List[Dict[str, Any]]:
    with open(path, "r", encoding="utf-8-sig") as f:
        return json.load(f)

def call_gemini(prompt: str, api_key: str, model: str = "gemini-2.5-flash") -> str:
    """
    Calls Google Gemini API using native urllib (zero external pip dependencies required).
    """
    # Primary model fallback order: gemini-2.5-flash -> gemini-1.5-flash -> gemini-2.0-flash
    endpoint = f"https://generativelanguage.googleapis.com/v1beta/models/{model}:generateContent?key={api_key}"
    payload = {
        "contents": [{
            "parts": [{"text": prompt}]
        }],
        "generationConfig": {
            "temperature": 0.2,
            "responseMimeType": "application/json"
        }
    }
    data = json.dumps(payload).encode("utf-8")
    req = urllib.request.Request(endpoint, data=data, headers={"Content-Type": "application/json"})

    try:
        with urllib.request.urlopen(req, timeout=30) as resp:
            res_body = resp.read().decode("utf-8")
            parsed = json.loads(res_body)
            candidates = parsed.get("candidates", [])
            if candidates:
                content_parts = candidates[0].get("content", {}).get("parts", [])
                if content_parts:
                    return content_parts[0].get("text", "")
            return "{}"
    except urllib.error.HTTPError as e:
        error_msg = e.read().decode("utf-8")
        # Try fallback if model not found
        if e.code == 404 and model != "gemini-1.5-flash":
            return call_gemini(prompt, api_key, model="gemini-1.5-flash")
        raise RuntimeError(f"Gemini API HTTP {e.code}: {error_msg}")

def build_validation_prompt(tool: Dict[str, Any]) -> str:
    clean_cat = tool.get("cleanCategory", tool.get("category", ""))
    return f"""
You are an elite SEO auditor, senior AI technical writer, and plagiarism detection specialist.
Evaluate the following AI Tool directory profile for the GoogleAITools.com publication.

Tool Profile Data:
- ID: #{tool.get('id')}
- Name: {tool.get('name')}
- Clean URL Slug: /ai-directory/{tool.get('slug')}/
- Canonical URL: https://googleaitools.com/ai-directory/{tool.get('slug')}/
- Sector / Category: {clean_cat}
- Form Factor: {tool.get('formFactor')}
- Official Website: {tool.get('website')}
- Verified Domain: {tool.get('domain')}
- Executive Summary: {tool.get('summary')}

Generated Content On Dedicated Page:
- Title: {tool.get('name')} ({tool.get('formFactor')}) Review & Architecture Specs | Google AI Tools
- H1: {tool.get('name')}
- Architecture Section: Core architectural value proposition, deterministic tool usage, context grounding.
- Capabilities Section: 4 key superpowers (autonomous execution, environmental grounding, workflow integration, enterprise privacy).
- Ecosystem Synergy: Integration with Google Gemini, Vertex AI, Android, and Chrome extensions.
- Factsheet Table: ID, Sector, Form Factor, Domain, Verification.

Perform a rigorous evaluation across these 4 MANDATORY CRITERIA:
1. "informative_and_human_written":
   - Does this explain genuine technical value?
   - Does it sound like an expert technical founder/engineer wrote it rather than low-quality generic AI spam?
   - Score 1-10 with critique.
2. "on_page_seo_score":
   - Is the clean URL structure (/ai-directory/{tool.get('slug')}/) optimal?
   - Are keywords in Title, H1, H2, and meta description natural and high-CTR?
   - Score 1-10 with critique.
3. "technical_and_content_integrity":
   - Are the form factor ({tool.get('formFactor')}) and category aligned?
   - Is domain attribution verified?
   - Score 1-10 with critique.
4. "uniqueness_and_plagiarism_safety":
   - Is the angle sufficiently unique and free from duplicate-content penalties?
   - Score 1-10 with critique.

Return ONLY a valid JSON object matching this exact schema:
{{
  "tool_id": {tool.get('id')},
  "tool_name": "{tool.get('name')}",
  "slug": "{tool.get('slug')}",
  "overall_score": 95,
  "status": "PASS",
  "criteria_scores": {{
    "informative_and_human_written": {{ "score": 9, "analysis": "..." }},
    "on_page_seo": {{ "score": 10, "analysis": "..." }},
    "technical_integrity": {{ "score": 9, "analysis": "..." }},
    "uniqueness_and_plagiarism_safety": {{ "score": 10, "analysis": "..." }}
  }},
  "strengths": ["...", "..."],
  "seo_recommendations": ["..."]
}}
"""

def validate_tool(tool: Dict[str, Any], api_key: str) -> Dict[str, Any]:
    prompt = build_validation_prompt(tool)
    raw_response = call_gemini(prompt, api_key)
    try:
        # Strip potential markdown code fences
        cleaned = raw_response.strip()
        if cleaned.startswith("```json"):
            cleaned = cleaned[7:]
        if cleaned.startswith("```"):
            cleaned = cleaned[3:]
        if cleaned.endswith("```"):
            cleaned = cleaned[:-3]
        return json.loads(cleaned.strip())
    except Exception as e:
        return {
            "tool_id": tool.get("id"),
            "tool_name": tool.get("name"),
            "slug": tool.get("slug"),
            "overall_score": 0,
            "status": "ERROR",
            "error": f"Failed to parse Gemini output: {str(e)}",
            "raw": raw_response
        }

def print_result_card(res: Dict[str, Any]):
    status = res.get("status", "UNKNOWN")
    score = res.get("overall_score", 0)
    name = res.get("tool_name", "")
    tool_id = res.get("tool_id", "")
    slug = res.get("slug", "")

    # Status color badge
    badge = f"[{status}]"
    print(f"\n{'='*75}")
    print(f"#{tool_id} {name.upper()}  (Slug: /ai-directory/{slug}/)  {badge}  Score: {score}/100")
    print(f"{'='*75}")

    criteria = res.get("criteria_scores", {})
    for crit, data in criteria.items():
        crit_label = crit.replace("_", " ").title()
        print(f"  • {crit_label:<32}: {data.get('score', 0)}/10")
        print(f"    Analysis: {data.get('analysis', '')[:120]}...")

    strengths = res.get("strengths", [])
    if strengths:
        print("\n  Top Strengths:")
        for s in strengths[:2]:
            print(f"    ✓ {s}")

    recs = res.get("seo_recommendations", [])
    if recs:
        print("\n  SEO & Editorial Improvements:")
        for r in recs[:2]:
            print(f"    → {r}")

def generate_markdown_report(results: List[Dict[str, Any]], output_path: str):
    avg_score = sum(r.get("overall_score", 0) for r in results) / max(len(results), 1)
    passed_count = sum(1 for r in results if r.get("status") == "PASS")
    
    lines = [
        "# GoogleAITools.com - AI Directory Content & SEO Validation Report",
        "",
        f"- **Date Generated**: {time.strftime('%Y-%m-%d %H:%M:%S UTC', time.gmtime())}",
        f"- **Audited Tools**: {len(results)}",
        f"- **Average Quality Score**: {avg_score:.1f}/100",
        f"- **Passed Strict Audit**: {passed_count}/{len(results)} ({passed_count/max(len(results),1)*100:.1f}%)",
        "",
        "## Summary Scorecard",
        "",
        "| ID | Tool Name | Clean Slug | Status | Overall Score | Human Tone | On-Page SEO | Uniqueness |",
        "|---|---|---|---|---|---|---|---|"
    ]

    for r in results:
        crit = r.get("criteria_scores", {})
        s_human = crit.get("informative_and_human_written", {}).get("score", "-")
        s_seo = crit.get("on_page_seo", {}).get("score", "-")
        s_uniq = crit.get("uniqueness_and_plagiarism_safety", {}).get("score", "-")
        lines.append(
            f"| #{r.get('tool_id')} | **{r.get('tool_name')}** | `{r.get('slug')}` | "
            f"{r.get('status')} | **{r.get('overall_score')}/100** | {s_human}/10 | {s_seo}/10 | {s_uniq}/10 |"
        )

    lines.append("\n## Detailed Tool Findings & Recommendations\n")
    for r in results:
        lines.append(f"### #{r.get('tool_id')} {r.get('tool_name')} (`/ai-directory/{r.get('slug')}/`)")
        lines.append(f"**Overall Score:** {r.get('overall_score')}/100 — Status: `{r.get('status')}`\n")
        
        crit = r.get("criteria_scores", {})
        for c_key, c_data in crit.items():
            lines.append(f"- **{c_key.replace('_', ' ').title()}** ({c_data.get('score', 0)}/10): {c_data.get('analysis', '')}")
        
        lines.append("\n**Key Strengths:**")
        for s in r.get("strengths", []):
            lines.append(f"- ✓ {s}")

        lines.append("\n**On-Page SEO Action Items:**")
        for rec in r.get("seo_recommendations", []):
            lines.append(f"- → {rec}")
        lines.append("\n---\n")

    with open(output_path, "w", encoding="utf-8") as f:
        f.write("\n".join(lines))
    print(f"\n[REPORT SAVED] Full detailed report written to: {output_path}")

def main():
    parser = argparse.ArgumentParser(description="Validate GoogleAITools AI directory pages using Google Gemini.")
    parser.add_argument("--api-key", default=os.getenv("GEMINI_API_KEY", ""), help="Google Gemini API Key (or set GEMINI_API_KEY env var)")
    parser.add_argument("--data", default=None, help="Path to global-ai-products.json")
    parser.add_argument("--tool", default=None, help="Validate a single tool by slug or name (e.g. devin, comet, cursor)")
    parser.add_argument("--limit", type=int, default=5, help="Number of tools to audit (default: 5, use --all for full catalog)")
    parser.add_argument("--all", action="store_true", help="Audit all 160 tools")
    parser.add_argument("--output", default="ai_tools_audit_report.md", help="Path to save markdown report")
    parser.add_argument("--rate-delay", type=float, default=1.5, help="Seconds delay between Gemini API calls (default: 1.5)")

    args = parser.parse_args()

    # Determine API key
    api_key = args.api_key.strip()
    if not api_key:
        print("[!] No Gemini API key provided via --api-key or GEMINI_API_KEY environment variable.")
        print("    You can get a free Gemini API key at: https://aistudio.google.com/")
        print("    Example:")
        print("      python validate_ai_tools_gemini.py --api-key YOUR_KEY --limit 3\n")
        sys.exit(1)

    # Locate dataset
    data_path = args.data or find_data_file()
    print(f"[*] Loading tools dataset from: {data_path}")
    products = load_products(data_path)
    print(f"[*] Total tools available in catalog: {len(products)}")

    # Filter target tools
    if args.tool:
        target = args.tool.lower().strip()
        products_to_check = [
            p for p in products 
            if p.get("slug", "").lower() == target 
            or p.get("name", "").lower() == target 
            or str(p.get("id")) == target
        ]
        if not products_to_check:
            print(f"[!] No tool matching '{args.tool}' found in catalog.")
            sys.exit(1)
    elif args.all:
        products_to_check = products
    else:
        products_to_check = products[:args.limit]

    print(f"[*] Starting Gemini validation for {len(products_to_check)} tool(s)...")

    results = []
    for idx, tool in enumerate(products_to_check, 1):
        print(f"\n[{idx}/{len(products_to_check)}] Auditing #{tool.get('id')} {tool.get('name')} with Gemini...", end="", flush=True)
        try:
            res = validate_tool(tool, api_key)
            results.append(res)
            print_result_card(res)
        except Exception as e:
            print(f"\n[!] Error auditing {tool.get('name')}: {e}")
        
        if idx < len(products_to_check):
            time.sleep(args.rate_delay)

    # Save output report
    generate_markdown_report(results, args.output)

if __name__ == "__main__":
    main()
