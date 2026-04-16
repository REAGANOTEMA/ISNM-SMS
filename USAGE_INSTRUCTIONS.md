# 🎓 ISNM Website - Header & Footer Integration Guide

## Quick Start

I've created reusable header and footer files that you can use on ALL your pages. This ensures consistent navigation and styling across your entire website.

---

## 📁 Files Created

### 1. **header.php**
- Contains: PHP headers, DOCTYPE, meta tags, all CSS styling, and navigation menu
- Includes: Fixed header with brand banner and navigation bar
- Opens the HTML structure and main tag

### 2. **footer.php**
- Contains: Footer section with links and JavaScript
- Includes: Footer styling and scroll effects
- Closes the HTML structure

### 3. **template-example.php**
- Shows how to use header.php and footer.php
- Use this as a reference for other pages

---

## 🚀 How to Use on All Pages

### For Any Page (about.php, programs.php, etc.):

Replace the entire page content with this structure:

```php
<?php
require_once 'header.php';
?>

<!-- Your Page-Specific Content Goes Here -->
<section style="max-width: 1200px; margin: 2rem auto; padding: 0 2rem;">
    <div style="background: white; padding: 3rem; border-radius: 12px;">
        <h1>Your Page Title</h1>
        <p>Your content here...</p>
    </div>
</section>

<?php
require_once 'footer.php';
?>
```

---

## 📋 Navigation Menu

The header automatically includes links to all these pages:

✅ **Home** - index.php
✅ **About** - about.php
✅ **Governance** - governance.php
✅ **Programs** - programs.php
✅ **Admissions** - admissions.php
✅ **Activities** - activities.php
✅ **Infrastructure** - infrastructure.php
✅ **Achievements** - achievements.php
✅ **History** - history.php
✅ **Contact** - contact.php
✅ **Portal** - login-portal.php

---

## 🎨 Features Included

### Header (header.php)
- ✅ Fixed brand banner with school name marquee (scrolling text)
- ✅ Professional navigation bar with all page links
- ✅ School logo with responsive sizing
- ✅ Smooth scroll effect on navigation
- ✅ Golden gradient styling
- ✅ Mobile-responsive design
- ✅ Perfect spacing (no gaps)
- ✅ Crystal clear hero image support

### Footer (footer.php)
- ✅ Quick links section
- ✅ Admissions section
- ✅ Contact information
- ✅ WhatsApp contact buttons
- ✅ Copyright notice
- ✅ Responsive grid layout

---

## 📱 Responsive Breakpoints

The header and footer automatically adjust for:
- **Desktop** (1024px+) - Full navigation
- **Tablet** (768px-1023px) - Compact navigation
- **Mobile** (480px-767px) - Minimal navigation
- **Small Mobile** (<480px) - Logo only, no nav links

---

## 🔧 Customization

### To Change Page Title:
Edit `header.php` line with `<title>` tag

### To Add New Navigation Link:
Edit `header.php` and add to the nav-links section:
```html
<a href="your-page.php" class="nav-link">Your Page</a>
```

### To Change Colors:
Modify CSS variables in `header.php` `:root` section:
```css
--primary-dark: #1a1a1a;
--accent-gold: #FFD700;
```

---

## 📝 Examples

### About Page (about.php)
```php
<?php require_once 'header.php'; ?>

<section style="max-width: 1200px; margin: 2rem auto; padding: 0 2rem;">
    <h1>About ISNM</h1>
    <p>Your about content here...</p>
</section>

<?php require_once 'footer.php'; ?>
```

### Programs Page (programs.php)
```php
<?php require_once 'header.php'; ?>

<section style="max-width: 1200px; margin: 2rem auto; padding: 0 2rem;">
    <h1>Our Programs</h1>
    <div class="programs-grid">
        <!-- Program cards here -->
    </div>
</section>

<?php require_once 'footer.php'; ?>
```

---

## ✨ Key Features

### Brand Banner (Top - 40px)
- Scrolling marquee text
- School name and taglines
- Golden gradient background
- Always visible

### Navigation Bar (Below Banner)
- Professional styling
- Hover effects
- All pages linked
- Mobile responsive

### Content Area
- Starts at 100px from top (accounting for header)
- Maximum width of 1200px for desktop
- Responsive padding
- Clean white background option available

### Footer
- Full-width dark background
- Quick links organized
- Contact information
- WhatsApp buttons
- Mobile responsive

---

## 🎯 Next Steps

1. ✅ **Update all pages** using the template structure
2. ✅ **Test navigation** - Click links to verify they work
3. ✅ **Check responsive** - View on mobile/tablet
4. ✅ **Verify links** - Ensure all pages have correct file names

---

## 💡 Tips

- Keep all `.php` files in the same directory
- Use relative paths (`header.php` not `/header.php`)
- Don't modify the core header.php and footer.php unless adding new features
- Test each page after creating it
- Keep consistent spacing: `<section>` with max-width and padding

---

## 🆘 Troubleshooting

**Navigation not showing?**
- Check `require_once 'header.php';` is at top of file
- Verify file is in same directory as pages

**Footer missing?**
- Check `require_once 'footer.php';` is at end of file
- Make sure file name matches exactly

**Styling looks wrong?**
- Clear browser cache (Ctrl+F5)
- Check file paths are correct
- Verify `assets/modern-theme.css` exists

---

## 📞 Support

For any issues with the header/footer system:
- Contact: Reagan Otema via WhatsApp
- You can customize further as needed

---

**Created: 2026**
**Version: 1.0**
**Status: Production Ready** ✅
