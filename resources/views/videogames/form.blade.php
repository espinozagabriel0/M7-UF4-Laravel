<div class="mb-4">
    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
    <input type="text" name="title" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('title', $videogame->title ?? '') }}">
    @error('title')
        <small class="text-red-600">{{ $message }}</small>
    @enderror
</div>

<div class="mb-4">
    <label for="genre" class="block text-sm font-medium text-gray-700 mb-1">Género</label>
    <input type="text" name="genre" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('genre', $videogame->genre ?? '') }}">
    @error('genre')
        <small class="text-red-600">{{ $message }}</small>
    @enderror
</div>

<div class="mb-4">
    <label for="developer" class="block text-sm font-medium text-gray-700 mb-1">Desarrollador</label>
    <input type="text" name="developer" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('developer', $videogame->developer ?? '') }}">
    @error('developer')
        <small class="text-red-600">{{ $message }}</small>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
    <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description', $videogame->description ?? '') }}</textarea>
    @error('description')
        <small class="text-red-600">{{ $message }}</small>
    @enderror
</div>
