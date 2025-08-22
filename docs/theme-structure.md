# EMC Theme Structure Documentation

## Overview

This document describes the restructured view organization for the EMC application using a custom Zeus theme.

## New Theme Structure

The application now uses a custom `emc` theme located at:
```
resources/views/vendor/zeus/themes/emc/
```

### Directory Structure

```
```
resources/views/vendor/zeus/themes/emc/
├── auth/                       # Authentication views
│   ├── login.blade.php
│   ├── register.blade.php
│   ├── forgot-password.blade.php
│   ├── reset-password.blade.php
│   ├── verify-email.blade.php
│   ├── confirm-password.blade.php
│   └── two-factor-challenge.blade.php
├── legal/                      # Legal pages
│   ├── terms.blade.php
│   └── privacy.blade.php
├── emails/                     # Email templates
│   └── team-invitation.blade.php
├── components/
│   ├── tinymce-editor.blade.php # Reusable TinyMCE component
│   └── application-mark.blade.php # Application branding
├── partials/
│   ├── header.blade.php        # Header partial
│   ├── footer.blade.php        # Footer partial
│   ├── footer-scripts.blade.php # Footer scripts
│   └── sidebar/                # Sidebar components
├── private/                    # Authenticated user pages
│   ├── create-event.blade.php
│   ├── edit-event.blade.php
│   ├── create-business.blade.php
│   ├── edit-business.blade.php
│   ├── dashboard.blade.php
│   ├── events-list.blade.php
│   ├── businesses-list.blade.php
│   ├── profile.blade.php
│   └── member.blade.php
├── public/                     # Public pages
├── addons/                     # Theme addons
├── home.blade.php              # Homepage
├── page.blade.php              # Generic page template
├── post.blade.php              # Blog post template
├── category.blade.php          # Category template
├── tags.blade.php              # Tags template
└── welcome.blade.php           # Welcome page
```
```

## Configuration Changes

The following configuration changes were made:

### config/zeus.php
```php
'theme' => 'emc',
'layout' => 'zeus::components.app',
```

## Updated References

The following files were updated to use the new EMC theme structure:

### Authentication Views (FortifyServiceProvider.php)
- All Fortify authentication views now point to `zeus::themes.emc.auth.*`

### Legal Pages (routes/web.php)
- Terms and privacy routes now point to `zeus::themes.emc.legal.*`

### Zeus Components
- `zeus::components.app` and `zeus::components.private-app` now directly include EMC theme partials
- No longer dependent on `$skyTheme` variable

### app/Providers/FortifyServiceProvider.php
Updated all authentication view paths:
- `auth.login` → `zeus::themes.emc.auth.login`
- `auth.register` → `zeus::themes.emc.auth.register`
- `auth.forgot-password` → `zeus::themes.emc.auth.forgot-password`
- `auth.reset-password` → `zeus::themes.emc.auth.reset-password`
- `auth.verify-email` → `zeus::themes.emc.auth.verify-email`
- `auth.two-factor-challenge` → `zeus::themes.emc.auth.two-factor-challenge`
- `auth.confirm-password` → `zeus::themes.emc.auth.confirm-password`

### routes/web.php
Updated legal page routes:
- `legal.terms` → `zeus::themes.emc.legal.terms`
- `legal.privacy` → `zeus::themes.emc.legal.privacy`

## Component Usage

### TinyMCE Editor Component

The TinyMCE editor is now available as a reusable component:

```blade
<x-zeus::themes.emc.components.tinymce-editor 
    selector="#description" 
    placeholder="Your placeholder text..." 
    :extraConfig="['border_radius' => '1rem']"
/>
```

#### Props:
- `selector`: CSS selector for the textarea element
- `placeholder`: Placeholder text for the editor
- `height`: Editor height (default: 300)
- `extraConfig`: Additional configuration options

## Benefits of This Structure

1. **Organization**: All theme-related files are organized under a single theme directory
2. **Maintainability**: Easy to find and modify theme-specific files
3. **Consistency**: All components follow Zeus theme conventions
4. **Reusability**: Components can be easily reused across templates
5. **Separation of Concerns**: Clear separation between public and private areas

## Migration Summary

- ✅ Created custom `emc` theme structure
- ✅ Moved all sky theme files to emc theme
- ✅ Reorganized components and partials
- ✅ Moved auth views and updated Fortify configuration
- ✅ Moved legal views and updated route configuration
- ✅ Moved email templates to theme structure
- ✅ Moved Inertia layout to theme layouts (removed unused)
- ✅ Updated configuration to use new theme
- ✅ Updated all TinyMCE component references
- ✅ Updated all controller view references to EMC theme
- ✅ Removed all skyTheme variables and references
- ✅ Completely removed old zeus/sky theme folder
- ✅ Verified build process works correctly
- ✅ Centralized all views under single EMC theme directory
- ✅ Cleaned up all obsolete references

## Usage

The theme is now active and all existing functionality will work with the new organized structure. No changes to controllers or routes are required.
