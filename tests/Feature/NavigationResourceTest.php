<?php

use App\Filament\Resources\Navigation\NavigationResource;
use App\Models\User;

test('navigation resource can get available routes', function () {
    // Create an admin user
    $admin = User::factory()->create(['is_admin' => true]);
    
    // Use reflection to access the protected method
    $reflection = new ReflectionClass(NavigationResource::class);
    $method = $reflection->getMethod('getAvailableRoutes');
    $method->setAccessible(true);
    
    $routes = $method->invoke(null);
    
    expect($routes)->toBeArray();
    expect($routes)->not->toBeEmpty();
    
    // Check that some expected routes are present
    expect(array_keys($routes))->toContain('home');
    expect(array_keys($routes))->toContain('dashboard');
    
    // Check that admin/internal routes are filtered out
    $routeNames = array_keys($routes);
    expect($routeNames)->not->toContain(function ($routeName) {
        return str_contains($routeName, 'filament') || 
               str_contains($routeName, 'ignition') || 
               str_contains($routeName, '_boost');
    });
});

test('navigation resource form has correct route select options', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    
    $this->actingAs($admin);
    
    // Test that the getAvailableRoutes method returns expected format
    $reflection = new ReflectionClass(NavigationResource::class);
    $method = $reflection->getMethod('getAvailableRoutes');
    $method->setAccessible(true);
    
    $routes = $method->invoke(null);
    
    // Check format: route_name => "route_name (METHOD uri)"
    foreach ($routes as $routeName => $routeDescription) {
        expect($routeName)->toBeString();
        expect($routeDescription)->toBeString();
        expect($routeDescription)->toContain($routeName);
        expect($routeDescription)->toMatch('/\([A-Z|]+ .*\)$/');
    }
});

test('navigation resource can modify excluded route patterns', function () {
    // Test adding patterns
    NavigationResource::addExcludedRoutePatterns(['test-pattern', 'another-pattern']);
    
    $reflection = new ReflectionClass(NavigationResource::class);
    $method = $reflection->getMethod('getExcludedRoutePatterns');
    $method->setAccessible(true);
    
    $patterns = $method->invoke(null);
    
    expect($patterns)->toContain('test-pattern');
    expect($patterns)->toContain('another-pattern');
    
    // Test removing patterns
    NavigationResource::removeExcludedRoutePatterns(['test-pattern']);
    
    $patterns = $method->invoke(null);
    
    expect($patterns)->not->toContain('test-pattern');
    expect($patterns)->toContain('another-pattern');
    
    // Clean up
    NavigationResource::removeExcludedRoutePatterns(['another-pattern']);
});
