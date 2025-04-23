# lowmark

```
 ███
 ███
 ███    ██████    ██   ██    █████ ████     ██████     ████  ███   ██
 ███  ███    ███  ██   ██   ██  ███  ███  ███    ██   ███    ███  ███
 ███  ███    ███  ███  ███  ██   ██   ██  ███   ████  ███    ███████
 ███    ██████     ████ █████    ██   ██   ██████ ██  ███    ███   ██
```

**Lowmark Zero: Reach the bottom of simplicity – A minimalist version of the low-tech Markdown website generator.**

Version: 0.1-zero  
Last updated: 2025-04-23  
Homepage: https://lowmark.de  
Demo Site: https://zero.lowmark.de  
Repository: https://github.com/weitblick/lowmark_zero

Copyright (c) 2025 Erhard Maria Klein, lowmark.de  
Licensed under the MIT License  
See LICENSE file or https://opensource.org/licenses/MIT

Depends on: Parsedown & ParsedownExtra from https://parsedown.org/

---

## What is lowmark?

**Create websites with ease – using just Markdown.**

- Write and publish your content as simple Markdown files
- This “CMS” is technically just a small PHP script
- No technical skills required – installation and usage take just a few minutes
- The core innovation is its radical simplicity, putting content back at the center
- Inspired by the ideals of the [Lowtech](https://solar.lowtechmagazine.com/), [Slow Media](https://www.slow-media.net/manifest) and [Small Web](https://smallweb.page/home) movements

Our goal is to create a lightweight online space where documents are simply documents — respecting the privacy, attention, and cognitive capacity of every reader, and promoting both mental and ecological sustainability.

> **Lowmark** isn’t about tech – it’s about values.

Learn more about the philosophy behind lowmark → [lowmark.de/about.html](https://lowmark.de/about.html)

---

## Installation

### 1. Download the repository

#### Option A: Clone via Git

```bash
git clone git clone https://github.com/weitblick/lowmark_zero.git
```

#### Option B: Download ZIP archive

1. Click on **"Code" → "Download ZIP"**
2. Extract the archive to a folder of your choice

### 2. Deploy your site

- Upload all files to a web server

  

---

## Project Structure

```
content/              → Page content in Markdown format
  └── index.md        → Homepage

lowmark/                  → Core logic of the site generator
  ├── core.php            → Get markdown file and render it to HTML
  ├── frontmatter.php     → Frontmatter parser
  ├── Parsedown.php       → Markdown parser
  └── ParsedownExtra.php  → Extended Markdown support

.htaccess             → URL rewriting for Apache servers
config.php            → Base configuration (must be customized!)
index.php             → Main template file; initializes lowmark by calling core.php

```

---

## System Requirements

- **Webserver**: Apache
- **PHP**: Version **8.0** or higher
