<a href="{{ route('tags',[$tag->type,$tag->slug]) }}" 
   class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
    #{{ $tag->name ?? '' }}
</a>
