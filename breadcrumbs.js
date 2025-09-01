(function () {
  const bc = document.getElementById('breadcrumbs');
  if (!bc) return;

  const path = window.location.pathname;
  const file = path.substring(path.lastIndexOf('/') + 1);

  // Always start with Home
  const parts = [`<a href="index.html">Home</a>`];

  if (file === 'index.html' || file === '') {
    // Main site hub
    bc.innerHTML = parts.join(' › ');
  } 
  else if (file === 'news.html') {
    // News hub
    parts.push('News Not Boring');
    bc.innerHTML = parts.join(' › ');
  } 
  else if (file.startsWith('ext-')) {
    // Category page: ext-lifestyle.html → Lifestyle
    const category = file
      .replace('ext-', '')
      .replace('.html', '')
      .replace(/-/g, ' ');
    const categoryName = category.charAt(0).toUpperCase() + category.slice(1);
    parts.push(`<a href="news.html">News Not Boring</a>`);
    parts.push(categoryName);
    bc.innerHTML = parts.join(' › ');
  } 
  else if (file.includes('-article-')) {
    // Article page: lifestyle-article-1.html → Lifestyle
    const category = file.split('-article-')[0];
    const categoryName = category.charAt(0).toUpperCase() + category.slice(1);
    const categoryLink = `ext-${category}.html`;
    const articleTitle = document.querySelector('h2')?.textContent || 'Article';
    parts.push(`<a href="news.html">News Not Boring</a>`);
    parts.push(`<a href="${categoryLink}">${categoryName}</a>`);
    parts.push(articleTitle);
    bc.innerHTML = parts.join(' › ');
  }
})();
