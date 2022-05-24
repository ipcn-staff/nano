export default function() {

  const headerYouTubePlayer = document.getElementById('js-header-youtube__player');

  // This code loads the IFrame Player API code asynchronously
  const tag = document.createElement('script');
  tag.src = 'https://www.youtube.com/iframe_api';

  const firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // This function creates an <iframe> (and YouTube player)
  // after the API code downloads
  window.onYouTubeIframeAPIReady = () => {
    const settings = {
      videoId: headerYouTubePlayer.dataset.videoId,
      playerVars: {
        controls: 0,
        loop: 1,
        playlist: headerYouTubePlayer.dataset.videoId,
        rel: 0,
        showinfo: 0
      },
      events: {
        onReady: onPlayerReady
      }
    }
    const player = new YT.Player(headerYouTubePlayer.id, settings);
  }

  // The API will call this function when the video player is ready.
  function onPlayerReady(e) {
    e.target.mute();
    e.target.playVideo();
  }
}
