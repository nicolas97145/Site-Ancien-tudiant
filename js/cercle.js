var colist = new Array('blue', 'red', 'green', 'orange', 'gray', 'yellow','#9932CC','#87CEEB','#F5DEB3');
function pie(ctx, w, h, datalist, name)
{
  var radius = h / 2 - 5;
  var centerx = w / 2;
  var centery = h / 2;
  var total = 0;
  for(x=0; x < datalist.length; x++) { total += datalist[x]; };
  var lastend=0;
  var offset = Math.PI / 2;
  for(x=0; x < datalist.length; x++)
  {
    var thispart = datalist[x];
    ctx.beginPath();
    ctx.fillStyle = colist[x];
    ctx.moveTo(centerx,centery);
    var arcsector = Math.PI * (2 * thispart / total);
    ctx.arc(centerx, centery, radius, lastend - offset, lastend + arcsector - offset, false);
    ctx.lineTo(centerx, centery);
    ctx.fill();
    ctx.closePath();
    ctx.beginPath();
    alert(name[x]);
    ctx.fillText(name[x], 50, 0);
    ctx.closePath();
    lastend += arcsector;
  }
}
