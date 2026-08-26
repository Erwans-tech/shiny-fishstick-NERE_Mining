<div class="sub-nav">
    <a href="{{ $en ? route('english.news') : route('news.index') }}" class="{{ $section === 'news' ? 'active' : '' }}">{{ __('site.subnav_news', [], $loc) }}</a>
    <a href="{{ $en ? route('english.press') : route('press') }}" class="{{ $section === 'press' ? 'active' : '' }}">{{ __('site.subnav_press', [], $loc) }}</a>
    <a href="{{ $en ? route('english.gallery') : route('gallery') }}" class="{{ $section === 'gallery' ? 'active' : '' }}">{{ __('site.subnav_gallery', [], $loc) }}</a>
    <a href="{{ $en ? route('english.reports') : route('reports') }}" class="{{ in_array($section, ['reports', 'publications']) ? 'active' : '' }}">{{ __('site.subnav_reports', [], $loc) }}</a>
    <a href="{{ $en ? route('english.press.contact') : route('press.contact') }}" class="{{ $section === 'press-contact' ? 'active' : '' }}">{{ __('site.subnav_press_contact', [], $loc) }}</a>
</div>