            var ban = $('#banner a');
            var round = $('.ban');
            
            //Для указания номера текущего баннера
            var now=ban.length-1;
            var nowR=1;
            
            //Присваиваем определенный размер и позицию для подложки кружков
            $('#podl_ban').css({
                            'width': '{$ban}px',
                            'left': '{$podl}px'
            }).show();


                    

                         
            $('#ban$i').click(function(){
                clearInterval(timer);
                if (0===nowR) nowR = ban.length-1;
                    else nowR-=1;
                nowCl=$iR;
                nowRCl=$i;
                $(ban[nowCl]).css('left','0').show();
                
                $(round[nowRCl]).attr('class','ban ban_now');
                $(round[nowR]).attr('class','ban');
                $(ban[now]).animate({
                                'left':'-=729'
                
                }, 1500, function(){
                    $(ban[now]).hide();
                    $(ban[now]).css('z-index','4');
                    $(ban[nowCl]).css('z-index','5');
                    
                    now=nowCl;
                    nowR=nowRCl;
                    if (0===now) now=ban.length-1;
                        else now-=1;
                    
                    if ((ban.length-1)===nowR) nowR=0;
                        else nowR+=1;
                });
        //        var timer = setInterval(showNextBan, 3500);
                });
   

        
            function showNextBan(){
                if (0===now) $(ban[ban.length-1]).css('left','0').show();
                    else $(ban[now-1]).css('left','0').show();
                
                $(round[nowR]).attr('class','ban ban_now');
                if (0===nowR) $(round[ban.length-1]).attr('class','ban');
                    else $(round[nowR-1]).attr('class','ban');
                $(ban[now]).animate({
                                'left':'-=729'
                
                }, 1500, function(){
                    $(ban[now]).hide();
                    $(ban[now]).css('z-index','4');
                    $(ban[now-1]).css('z-index','5');
                    
                    if (0===now) now=ban.length-1;
                        else now-=1;
                    
                    if ((ban.length-1)===nowR) nowR=0;
                        else nowR+=1;
                });
            }
            var timer = setInterval(showNextBan, 3500);