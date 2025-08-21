<a href="{{ route('tags',[$category->type,$category->slug]) }}" 
   class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full hover:bg-blue-200 transition-colors dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-900/50">
    {{ $category->name ?? '' }}
</a>
