# EMC Theme Structure Documentation

## Overview

This document describes the restructured view organization for the EMC application using a custom Zeus theme.

## New Theme Structure

The application now uses a custom `emc` theme located at:
```
resources/views/themes/emc/
```

### Directory Structure

```
resources/views/themes/emc/
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
├── components/                 # Layout components
│   ├── app.blade.php          # Main application layout
│   ├── private-app.blade.php  # Private/authenticated layout
│   └── nav-item.blade.php     # Navigation item component
├── partial/                    # Reusable partials
│   ├── header.blade.php       # Header partial
│   ├── footer.blade.php       # Footer partial
│   ├── footer-scripts.blade.php # Footer scripts
│   ├── tinymce-editor.blade.php # TinyMCE editor component
│   ├── logo.blade.php         # Logo component
│   ├── password-form.blade.php # Password form component
│   ├── file-validator.blade.php # File validator component
│   ├── sidebar.blade.php      # Main sidebar
│   ├── category.blade.php     # Category partial
│   ├── post.blade.php         # Post partial
│   ├── tag.blade.php          # Tag partial
│   ├── related.blade.php      # Related content partial
│   ├── sticky.blade.php       # Sticky content partial
│   ├── empty.blade.php        # Empty state partial
│   ├── children-pages.blade.php # Child pages partial
│   └── sidebar/               # Sidebar components
│       ├── authors.blade.php
│       ├── categories.blade.php
│       ├── pages.blade.php
│       ├── recent.blade.php
│       └── search.blade.php
├── private/                    # Authenticated user pages
│   ├── create-event.blade.php
│   ├── edit-event.blade.php
│   ├── create-business.blade.php
│   ├── edit-business.blade.php
│   ├── view-business.blade.php
│   ├── dashboard.blade.php
│   ├── events-list.blade.php
│   ├── businesses-list.blade.php
│   ├── profile.blade.php
│   ├── member.blade.php
│   ├── library/
│   │   └── index.blade.php
│   └── partials/
│       ├── event-card.blade.php
│       └── event-feed-item.blade.php
├── businesses/                 # Business-related views
│   ├── index.blade.php
│   └── show.blade.php
├── events/                     # Event-related views
│   ├── index.blade.php
│   └── show.blade.php
├── addons/                     # Theme addons
│   ├── library-item.blade.php
│   ├── library-tag.blade.php
│   └── library-types/
│       ├── file.blade.php
│       ├── file-url.blade.php
│       └── video.blade.php
├── home.blade.php              # Homepage
├── page.blade.php              # Generic page template
├── post.blade.php              # Blog post template
├── category.blade.php          # Category template
├── tags.blade.php              # Tags template
└── welcome.blade.php           # Welcome page
```

### Email Templates

Email templates are located separately at:
```
resources/views/emails/
└── team-invitation.blade.php
```

## Configuration Changes

The following configuration changes were made:

### config/zeus.php
```php
'theme' => 'zeus',
'layout' => 'themes.emc.components.app',
```

## Updated References

The following files were updated to use the new EMC theme structure:

### Authentication Views (FortifyServiceProvider.php)
- All Fortify authentication views now point to `themes.emc.auth.*`

### Legal Pages (routes/web.php)
- Terms and privacy routes now point to `themes.emc.legal.*`

### Zeus Components
- `themes.emc.components.app` and `themes.emc.components.private-app` are the main layout components
- No longer dependent on `$skyTheme` variable

### app/Providers/FortifyServiceProvider.php
Updated all authentication view paths:
- `auth.login` → `themes.emc.auth.login`
- `auth.register` → `themes.emc.auth.register`
- `auth.forgot-password` → `themes.emc.auth.forgot-password`
- `auth.reset-password` → `themes.emc.auth.reset-password`
- `auth.verify-email` → `themes.emc.auth.verify-email`
- `auth.two-factor-challenge` → `themes.emc.auth.two-factor-challenge`
- `auth.confirm-password` → `themes.emc.auth.confirm-password`

### routes/web.php
Updated legal page routes:
- `legal.terms` → `themes.emc.legal.terms`
- `legal.privacy` → `themes.emc.legal.privacy`

## Component Usage

### TinyMCE Editor Component

The TinyMCE editor is now available as a reusable component located at `themes.emc.partial.tinymce-editor`:

```blade
@include('themes.emc.partial.tinymce-editor', [
    'selector' => '#description',
    'placeholder' => 'Your placeholder text...',
    'extraConfig' => ['border_radius' => '1rem']
])
```

#### Parameters:
- `selector`: CSS selector for the textarea element
- `placeholder`: Placeholder text for the editor
- `height`: Editor height (default: 300)
- `extraConfig`: Additional configuration options

### Navigation Component

The navigation item component is available at `themes.emc.components.nav-item`:

```blade
@include('themes.emc.components.nav-item', [
    // component parameters
])
```

## Benefits of This Structure

1. **Organization**: All theme-related files are organized under a single theme directory
2. **Maintainability**: Easy to find and modify theme-specific files
3. **Consistency**: All components follow Zeus theme conventions
4. **Reusability**: Components can be easily reused across templates
5. **Separation of Concerns**: Clear separation between public and private areas
6. **Modular Components**: Well-organized partials and components for better code reuse
7. **Feature-Based Organization**: Business and event views are grouped by feature

## Migration Summary

- ✅ Created custom `emc` theme structure
- ✅ Moved all theme files to `resources/views/themes/emc/`
- ✅ Reorganized components and partials into logical directories
- ✅ Moved auth views and updated Fortify configuration
- ✅ Moved legal views and updated route configuration
- ✅ Organized business and event views by feature
- ✅ Created comprehensive partial structure with sidebar components
- ✅ Established separate library functionality with addons
- ✅ Updated configuration to use new theme structure
- ✅ Updated all component references to EMC theme
- ✅ Removed all obsolete theme references
- ✅ Verified build process works correctly
- ✅ Centralized all views under single EMC theme directory
- ✅ Cleaned up all obsolete references
- ✅ Maintained separate email templates structure

## Usage

The theme is now active and all existing functionality works with the new organized structure. Controllers reference views using the `themes.emc.*` path structure.
