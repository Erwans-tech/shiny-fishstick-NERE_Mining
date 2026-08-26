<div class="sub-nav">
    <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}" class="{{ $section === 'sustainability' ? 'active' : '' }}">{{ __('site.subnav_overview', [], $loc) }}</a>
    <a href="{{ $en ? route('english.communities') : route('sustainability.communities') }}" class="{{ $section === 'communities' ? 'active' : '' }}">{{ __('site.subnav_communities', [], $loc) }}</a>
    <a href="{{ $en ? route('english.environment') : route('sustainability.environment') }}" class="{{ $section === 'environment' ? 'active' : '' }}">{{ __('site.subnav_environment', [], $loc) }}</a>
    <a href="{{ $en ? route('english.hse') : route('sustainability.hse') }}" class="{{ $section === 'hse' ? 'active' : '' }}">{{ __('site.subnav_hse', [], $loc) }}</a>
    <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}" class="{{ $section === 'local-content' ? 'active' : '' }}">{{ __('site.subnav_local_content', [], $loc) }}</a>
</div>