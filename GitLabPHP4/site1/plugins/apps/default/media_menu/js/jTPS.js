/*਍ ⨀ 樀吀倀匀 ⴀ 琀愀戀氀攀 猀漀爀琀椀渀最Ⰰ 瀀愀最椀渀愀琀椀漀渀Ⰰ 愀渀搀 愀渀椀洀愀琀攀搀 瀀愀最攀 猀挀爀漀氀氀椀渀最ഀഀ
 *	version 0.5.1਍ ⨀ 䄀甀琀栀漀爀㨀 䨀椀洀 倀愀氀洀攀爀ഀഀ
 * Released under MIT license.਍ ⨀⼀ഀഀ
 (function($) {਍ഀഀ
	// apply table controls + setup initial jTPS namespace within jQuery਍ऀ␀⸀昀渀⸀樀吀倀匀 㴀 昀甀渀挀琀椀漀渀 ⠀ 漀瀀琀 ⤀ 笀ഀഀ
਍ऀऀ␀⠀琀栀椀猀⤀⸀搀愀琀愀⠀✀琀愀戀氀攀匀攀琀琀椀渀最猀✀Ⰰ ␀⸀攀砀琀攀渀搀⠀笀ഀഀ
			perPages:			[5, 6, 10, 20, 50, 'ALL'],				// the "show per page" selection਍ऀऀऀ瀀攀爀倀愀最攀吀攀砀琀㨀ऀऀ✀匀栀漀眀 瀀攀爀 瀀愀最攀㨀✀Ⰰऀऀऀऀऀऀ⼀⼀ 琀攀砀琀 琀栀愀琀 愀瀀瀀攀愀爀猀 戀攀昀漀爀攀 瀀攀爀倀愀最攀猀 氀椀渀欀猀ഀഀ
			perPageDelim:		'<span style="color:#ccc;">|</span>',	// text or dom node that deliminates each perPage link ਍ऀऀऀ瀀攀爀倀愀最攀匀攀瀀攀爀愀琀漀爀㨀ऀ✀⸀⸀✀Ⰰऀऀऀऀऀऀऀऀऀ⼀⼀ 琀攀砀琀 漀爀 搀漀洀 渀漀搀攀 琀栀愀琀 搀攀氀椀洀椀渀愀琀攀猀 猀瀀氀椀琀 椀渀 猀攀氀攀挀琀 瀀愀最攀 氀椀渀欀猀ഀഀ
			scrollDelay:		30,										// delay (in ms) between steps in anim. - IE has trouble showing animation with < 30ms delay਍ऀऀऀ猀挀爀漀氀氀匀琀攀瀀㨀ऀऀऀ㈀Ⰰऀऀऀऀऀऀऀऀऀऀ⼀⼀ 栀漀眀 洀愀渀礀 琀爀✀猀 愀爀攀 猀挀爀漀氀氀攀搀 瀀攀爀 猀琀攀瀀 椀渀 琀栀攀 愀渀椀洀愀琀攀搀 瘀攀爀琀椀挀愀氀 瀀愀最椀渀愀琀椀漀渀 猀挀爀漀氀氀椀渀最ഀഀ
			fixedLayout:		true,									// autoset the width/height on each cell and set table-layout to fixed after auto layout਍ऀऀऀ挀氀椀挀欀䌀愀氀氀戀愀挀欀㨀ऀऀ昀甀渀挀琀椀漀渀 ⠀⤀ 笀紀ऀऀऀऀऀऀऀ⼀⼀ 挀愀氀氀戀愀挀欀 昀甀渀挀琀椀漀渀 愀昀琀攀爀 挀氀椀挀欀猀 漀渀 猀漀爀琀Ⰰ 瀀攀爀瀀愀最攀 愀渀搀 瀀愀最椀渀愀琀椀漀渀ഀഀ
		}, opt));਍ऀऀഀഀ
		// generic pass-through object + other initial variables਍ऀऀ瘀愀爀 瀀吀 㴀 ␀⠀琀栀椀猀⤀Ⰰ 瀀愀最攀 㴀 瀀愀最攀 簀簀 ㄀Ⰰ 瀀攀爀倀愀最攀猀 㴀 ␀⠀琀栀椀猀⤀⸀搀愀琀愀⠀✀琀愀戀氀攀匀攀琀琀椀渀最猀✀⤀⸀瀀攀爀倀愀最攀猀Ⰰ 瀀攀爀倀愀最攀 㴀 瀀攀爀倀愀最攀 簀簀 瀀攀爀倀愀最攀猀嬀　崀Ⰰഀഀ
			rowCount = $('>tbody', this).find('tr').length;਍ഀഀ
		// append jTPS class "stamp"਍ऀऀ␀⠀琀栀椀猀⤀⸀愀搀搀䌀氀愀猀猀⠀✀樀吀倀匀✀⤀㬀ഀഀ
		਍ऀऀ⼀⼀ 猀攀琀甀瀀 琀栀攀 昀椀砀攀搀 琀愀戀氀攀ⴀ氀愀礀漀甀琀 猀漀 琀栀愀琀 琀栀攀 愀渀椀洀愀琀椀漀渀 搀漀攀猀渀✀琀 戀漀甀渀挀攀 愀爀漀甀渀搀 ⴀ 昀愀甀砀 最爀椀搀 昀漀爀 琀愀戀氀攀ഀഀ
		if ( $(this).data('tableSettings').fixedLayout ) {਍ऀऀऀ⼀⼀ ∀昀椀砀∀ 琀栀攀 琀愀戀氀攀 氀愀礀漀甀琀 愀渀搀 椀渀搀椀瘀椀搀甀愀氀 挀攀氀氀 眀椀搀琀栀 ☀ 栀攀椀最栀琀 猀攀琀琀椀渀最猀ഀഀ
			if ( $(this).css('table-layout') != 'fixed' ) {਍ऀऀऀऀ⼀⼀ 昀椀渀搀 洀愀砀 琀戀漀搀礀 琀搀 挀攀氀氀 栀攀椀最栀琀ഀഀ
				var maxCellHeight = 0;਍ഀഀ
				// set width style on the TH headers (rely on jQuery with computed styles support)਍ऀऀऀऀ␀⠀✀㸀琀栀攀愀搀✀Ⰰ 琀栀椀猀⤀⸀昀椀渀搀⠀✀琀栀Ⰰ琀搀✀⤀⸀攀愀挀栀⠀昀甀渀挀琀椀漀渀 ⠀⤀ 笀 ␀⠀琀栀椀猀⤀⸀挀猀猀⠀✀眀椀搀琀栀✀Ⰰ ␀⠀琀栀椀猀⤀⸀眀椀搀琀栀⠀⤀⤀㬀 紀⤀㬀ഀഀ
਍ऀऀऀऀ⼀⼀ 攀渀猀甀爀攀 戀爀漀眀猀攀爀ⴀ昀漀爀洀愀琀攀搀 眀椀搀琀栀猀 昀漀爀 攀愀挀栀 挀漀氀甀洀渀 椀渀 琀栀攀 琀栀攀愀搀 愀渀搀 琀戀漀搀礀ഀഀ
				var tbodyCh = $('>tbody',this)[0].childNodes, tmpp = 0;਍ऀऀऀऀ⼀⼀ 氀漀漀瀀 琀栀爀漀甀最栀 琀戀漀搀礀 挀栀椀氀搀爀攀渀 愀渀搀 昀椀渀搀 琀栀攀 一琀栀 㰀吀刀㸀ഀഀ
				for ( var tbi=0, tbcl=tbodyCh.length; tbi < tbcl; tbi++ )਍ऀऀऀऀऀ椀昀 ⠀ 琀戀漀搀礀䌀栀嬀 琀戀椀 崀⸀渀漀搀攀一愀洀攀 㴀㴀 ✀吀刀✀ ⤀ഀഀ
						maxCellHeight = Math.max( maxCellHeight, tbodyCh[ tbi ].offsetHeight );਍ഀഀ
				// now set the height attribute and/or style to the first TD cell (not the row)਍ऀऀऀऀ昀漀爀 ⠀ 瘀愀爀 琀戀椀㴀　Ⰰ 琀戀挀氀㴀琀戀漀搀礀䌀栀⸀氀攀渀最琀栀㬀 琀戀椀 㰀 琀戀挀氀㬀 琀戀椀⬀⬀ ⤀ഀഀ
					if ( tbodyCh[ tbi ].nodeName == 'TR' )਍ऀऀऀऀऀऀ昀漀爀 ⠀ 瘀愀爀 琀搀椀㴀　Ⰰ 琀爀䌀栀㴀琀戀漀搀礀䌀栀嬀 琀戀椀 崀⸀挀栀椀氀搀一漀搀攀猀Ⰰ 琀搀挀氀㴀琀爀䌀栀⸀氀攀渀最琀栀㬀 琀搀椀 㰀 琀搀挀氀㬀 琀搀椀⬀⬀ ⤀ഀഀ
							if ( trCh[ tdi ].nodeName == 'TD' ) {਍ऀऀऀऀऀऀऀऀ琀爀䌀栀嬀 琀搀椀 崀⸀猀琀礀氀攀⸀栀攀椀最栀琀 㴀 洀愀砀䌀攀氀氀䠀攀椀最栀琀 ⬀ ✀瀀砀✀㬀ഀഀ
								tdi = tdcl;਍ऀऀऀऀऀऀऀ紀ഀഀ
				// now set the table layout to fixed਍ऀऀऀऀ␀⠀琀栀椀猀⤀⸀挀猀猀⠀✀琀愀戀氀攀ⴀ氀愀礀漀甀琀✀Ⰰ✀昀椀砀攀搀✀⤀㬀ഀഀ
			}਍ऀऀ紀ഀഀ
਍ऀऀ⼀⼀ 爀攀洀漀瘀攀 愀氀氀 猀琀甀戀 爀漀眀猀ഀഀ
		$('.stubCell', this).remove();਍ഀഀ
		// add the stub rows਍ऀऀ瘀愀爀 猀琀甀戀䌀漀甀渀琀㴀　Ⰰ 挀漀氀猀 㴀 䴀愀琀栀⸀洀愀砀⠀ ␀⠀✀㸀琀栀攀愀搀㨀昀椀爀猀琀 琀爀㨀氀愀猀琀 琀栀Ⰰ㸀琀栀攀愀搀㨀昀椀爀猀琀 琀爀㨀氀愀猀琀 琀搀✀Ⰰ 琀栀椀猀⤀⸀氀攀渀最琀栀Ⰰ 瀀愀爀猀攀䤀渀琀⠀ ␀⠀✀㸀琀栀攀愀搀㨀昀椀爀猀琀 琀爀㨀氀愀猀琀 琀栀Ⰰ㸀琀栀攀愀搀㨀昀椀爀猀琀 琀爀㨀氀愀猀琀 琀搀✀⤀⸀愀琀琀爀⠀✀挀漀氀猀瀀愀渀✀⤀ 簀簀 　 ⤀ ⤀Ⰰ ഀഀ
			stubs = ( perPage - ( $('>tbody>tr', this).length % perPage ) ),਍ऀऀऀ猀琀甀戀䠀攀椀最栀琀 㴀 ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀昀椀爀猀琀㸀琀搀㨀昀椀爀猀琀✀Ⰰ 琀栀椀猀⤀⸀挀猀猀⠀✀栀攀椀最栀琀✀⤀㬀ഀഀ
		for ( ; stubCount < stubs && stubs != perPage; stubCount++ )਍ऀऀऀ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀氀愀猀琀✀Ⰰ 琀栀椀猀⤀⸀愀昀琀攀爀⠀ ✀㰀琀爀 挀氀愀猀猀㴀∀猀琀甀戀䌀攀氀氀∀㸀㰀琀搀 挀漀氀猀瀀愀渀㴀∀✀ ⬀ 挀漀氀猀 ⬀ ✀∀ 猀琀礀氀攀㴀∀栀攀椀最栀琀㨀 ✀ ⬀ 猀琀甀戀䠀攀椀最栀琀 ⬀ ✀㬀∀㸀☀渀戀猀瀀㬀㰀⼀琀搀㸀㰀⼀琀爀㸀✀ ⤀㬀ഀഀ
਍ऀऀ⼀⼀ 瀀愀最椀渀愀琀攀 琀栀攀 爀攀猀甀氀琀ഀഀ
		if ( rowCount > perPage && perPage != 0 )਍ऀऀऀ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀最琀⠀✀ ⬀ ⠀瀀攀爀倀愀最攀 ⴀ ㄀⤀ ⬀ ✀⤀✀Ⰰ 琀栀椀猀⤀⸀愀搀搀䌀氀愀猀猀⠀✀栀椀搀攀吀刀✀⤀㬀ഀഀ
਍ऀऀ⼀⼀ 戀椀渀搀 猀漀爀琀 昀甀渀挀琀椀漀渀愀氀椀琀礀 琀漀 琀栀攀愀搀攀爀ഀഀ
		if (perPage != 0)਍ऀऀऀ␀⠀✀㸀琀栀攀愀搀 嬀猀漀爀琀崀Ⰰ㸀琀栀攀愀搀 ⸀猀漀爀琀✀Ⰰ 琀栀椀猀⤀⸀攀愀挀栀⠀ഀഀ
				function (tdInd) {਍ऀऀऀऀऀ␀⠀琀栀椀猀⤀⸀愀搀搀䌀氀愀猀猀⠀✀猀漀爀琀愀戀氀攀䠀攀愀搀攀爀✀⤀⸀甀渀戀椀渀搀⠀✀挀氀椀挀欀✀⤀⸀戀椀渀搀⠀✀挀氀椀挀欀✀Ⰰഀഀ
						function () {਍ऀऀऀऀऀऀऀ瘀愀爀 挀漀氀甀洀渀一漀 㴀 ␀⠀✀㸀琀栀攀愀搀 琀爀㨀氀愀猀琀✀Ⰰ 瀀吀⤀⸀挀栀椀氀搀爀攀渀⠀⤀⸀椀渀搀攀砀⠀ ␀⠀琀栀椀猀⤀ ⤀Ⰰഀഀ
								desc = $('>thead [sort],>thead .sort', pT).eq(columnNo).hasClass('sortAsc') ? true : false;਍ऀऀऀऀऀऀऀ⼀⼀ 猀漀爀琀 琀栀攀 爀漀眀猀ഀഀ
							sort( pT, columnNo, desc );਍ऀऀऀऀऀऀऀ⼀⼀ 猀栀漀眀 昀椀爀猀琀 瀀攀爀倀愀最攀猀 爀漀眀猀ഀഀ
							var page = parseInt( $('.hilightPageSelector:first', pT).html() ) || 1;਍ऀऀऀऀऀऀऀ␀⠀✀㸀琀戀漀搀礀㸀琀爀✀Ⰰ 瀀吀⤀⸀爀攀洀漀瘀攀䌀氀愀猀猀⠀✀栀椀搀攀吀刀✀⤀⸀昀椀氀琀攀爀⠀✀㨀最琀⠀✀ ⬀ ⠀ ⠀ 瀀攀爀倀愀最攀 ⴀ ㄀ ⤀ ⨀ 瀀愀最攀 ⤀ ⬀ ✀⤀✀⤀⸀愀搀搀䌀氀愀猀猀⠀✀栀椀搀攀吀刀✀⤀㬀ഀഀ
							$('>tbody>tr:lt(' + ( ( perPage - 1 ) * ( page - 1 ) ) + ')', pT).addClass('hideTR');਍ऀऀऀऀऀऀऀ⼀⼀ 猀挀爀漀氀氀 琀漀 昀椀爀猀琀 瀀愀最攀 椀昀 渀漀琀 愀氀爀攀愀搀礀ഀഀ
							if ($('.pageSelector', pT).index($('.hilightPageSelector', pT)) > 0)਍ऀऀऀऀऀऀऀऀ␀⠀✀⸀瀀愀最攀匀攀氀攀挀琀漀爀㨀昀椀爀猀琀✀Ⰰ 瀀吀⤀⸀挀氀椀挀欀⠀⤀㬀ഀഀ
							// hilight the sorted column header਍ऀऀऀऀऀऀऀ␀⠀✀㸀琀栀攀愀搀 ⸀猀漀爀琀䐀攀猀挀Ⰰ㸀琀栀攀愀搀 ⸀猀漀爀琀䄀猀挀✀Ⰰ 瀀吀⤀⸀爀攀洀漀瘀攀䌀氀愀猀猀⠀✀猀漀爀琀䐀攀猀挀✀⤀⸀爀攀洀漀瘀攀䌀氀愀猀猀⠀✀猀漀爀琀䄀猀挀✀⤀㬀ഀഀ
							$('>thead [sort],>thead .sort', pT).eq(columnNo).addClass( desc ? 'sortDesc' : 'sortAsc' );਍ऀऀऀऀऀऀऀ⼀⼀ 栀椀氀椀最栀琀 琀栀攀 猀漀爀琀攀搀 挀漀氀甀洀渀ഀഀ
							$('>tbody>tr>td.sortedColumn', pT).removeClass('sortedColumn');਍ऀऀऀऀऀऀऀ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀渀漀琀⠀⸀猀琀甀戀䌀攀氀氀⤀✀Ⰰ 瀀吀⤀⸀攀愀挀栀⠀ 昀甀渀挀琀椀漀渀 ⠀⤀ 笀 ␀⠀✀㸀琀搀㨀攀焀⠀✀ ⬀ 挀漀氀甀洀渀一漀 ⬀ ✀⤀✀Ⰰ 琀栀椀猀⤀⸀愀搀搀䌀氀愀猀猀⠀✀猀漀爀琀攀搀䌀漀氀甀洀渀✀⤀㬀 紀 ⤀㬀ഀഀ
							clearSelection();਍ऀऀऀऀऀऀऀ⼀⼀ 挀愀氀氀戀愀挀欀 昀甀渀挀琀椀漀渀 愀昀琀攀爀 瀀愀最椀渀愀琀椀漀渀 爀攀渀搀攀爀搀ഀഀ
							$(pT).data('tableSettings').clickCallback();਍ऀऀऀऀऀऀ紀ഀഀ
					);਍ऀऀऀऀ紀ഀഀ
			);਍ഀഀ
		// add perPage selection link + delim dom node਍ऀऀ␀⠀✀㸀⸀渀愀瘀 ⸀猀攀氀攀挀琀倀攀爀倀愀最攀✀Ⰰ 琀栀椀猀⤀⸀攀洀瀀琀礀⠀⤀㬀ഀഀ
		var pageSel = perPages.length;਍ऀऀ眀栀椀氀攀 ⠀ 瀀愀最攀匀攀氀ⴀⴀ ⤀ ഀഀ
			$('>.nav .selectPerPage', this).prepend( ( (pageSel > 0) ? $(this).data('tableSettings').perPageDelim : '' ) + ਍ऀऀऀऀ✀㰀猀瀀愀渀 挀氀愀猀猀㴀∀瀀攀爀倀愀最攀匀攀氀攀挀琀漀爀∀㸀✀ ⬀ 瀀攀爀倀愀最攀猀嬀瀀愀最攀匀攀氀崀 ⬀ ✀㰀⼀猀瀀愀渀㸀✀ ⤀㬀ഀഀ
਍ऀऀ⼀⼀ 渀漀眀 搀爀愀眀 琀栀攀 瀀愀最攀 猀攀氀攀挀琀漀爀猀ഀഀ
		drawPageSelectors( this, page || 1 );਍ഀഀ
		// prepend the instructions and attach select hover and click events਍ऀऀ␀⠀✀㸀⸀渀愀瘀 ⸀猀攀氀攀挀琀倀攀爀倀愀最攀✀Ⰰ 琀栀椀猀⤀⸀瀀爀攀瀀攀渀搀⠀ ␀⠀琀栀椀猀⤀⸀搀愀琀愀⠀✀琀愀戀氀攀匀攀琀琀椀渀最猀✀⤀⸀瀀攀爀倀愀最攀吀攀砀琀 ⤀⸀昀椀渀搀⠀✀⸀瀀攀爀倀愀最攀匀攀氀攀挀琀漀爀✀⤀⸀攀愀挀栀⠀ഀഀ
			function () {਍ऀऀऀऀ椀昀 ⠀ ⠀ 瀀愀爀猀攀䤀渀琀⠀␀⠀琀栀椀猀⤀⸀栀琀洀氀⠀⤀⤀ 簀簀 爀漀眀䌀漀甀渀琀 ⤀ 㴀㴀 瀀攀爀倀愀最攀 ⤀ഀഀ
					$(this).addClass('perPageSelected');਍ऀऀऀऀ␀⠀琀栀椀猀⤀⸀戀椀渀搀⠀✀洀漀甀猀攀漀瘀攀爀 洀漀甀猀攀漀甀琀✀Ⰰ ഀഀ
					function (e) { ਍ऀऀऀऀऀऀ攀⸀琀礀瀀攀 㴀㴀 ✀洀漀甀猀攀漀瘀攀爀✀ 㼀 ␀⠀琀栀椀猀⤀⸀愀搀搀䌀氀愀猀猀⠀✀瀀攀爀倀愀最攀䠀椀氀椀最栀琀✀⤀ 㨀 ␀⠀琀栀椀猀⤀⸀爀攀洀漀瘀攀䌀氀愀猀猀⠀✀瀀攀爀倀愀最攀䠀椀氀椀最栀琀✀⤀㬀ഀഀ
					}਍ऀऀऀऀ⤀㬀ഀഀ
				$(this).bind('click', ਍ऀऀऀऀऀ昀甀渀挀琀椀漀渀 ⠀⤀ 笀 ഀഀ
						// set the new number of pages਍ऀऀऀऀऀऀ瀀攀爀倀愀最攀 㴀 瀀愀爀猀攀䤀渀琀⠀ ␀⠀琀栀椀猀⤀⸀栀琀洀氀⠀⤀ ⤀ 簀簀 爀漀眀䌀漀甀渀琀㬀ഀഀ
						if ( perPage > rowCount ) perPage = rowCount;਍ऀऀऀऀऀऀ⼀⼀ 爀攀洀漀瘀攀 愀氀氀 猀琀甀戀 爀漀眀猀ഀഀ
						$('.stubCell', this).remove();਍ऀऀऀऀऀऀ⼀⼀ 爀攀搀爀愀眀 猀琀甀戀 爀漀眀猀ഀഀ
						var stubCount=0, cols = $('>thead th,>thead td', pT).length, ਍ऀऀऀऀऀऀऀ猀琀甀戀猀 㴀 ⠀ 瀀攀爀倀愀最攀 ⴀ ⠀ ␀⠀✀㸀琀戀漀搀礀㸀琀爀✀Ⰰ 瀀吀⤀⸀氀攀渀最琀栀 ─ 瀀攀爀倀愀最攀 ⤀ ⤀Ⰰ ഀഀ
							stubHeight = $('>tbody>tr:first>td:first', pT).css('height');਍ऀऀऀऀऀऀ昀漀爀 ⠀ 㬀 猀琀甀戀䌀漀甀渀琀 㰀 猀琀甀戀猀 ☀☀ 猀琀甀戀猀 ℀㴀 瀀攀爀倀愀最攀㬀 猀琀甀戀䌀漀甀渀琀⬀⬀ ⤀ഀഀ
							$('>tbody>tr:last', pT).after( '<tr class="stubCell"><td colspan="' + cols + '" style="height: ' + stubHeight + ';">&nbsp;</td></tr>' );਍ऀऀऀऀऀऀ⼀⼀ 猀攀琀 渀攀眀 瘀椀猀椀戀氀攀 爀漀眀猀ഀഀ
						$('>tbody>tr', pT).removeClass('hideTR').filter(':gt(' + ( ( perPage - 1 ) * page ) + ')').addClass('hideTR');਍ऀऀऀऀऀऀ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀氀琀⠀✀ ⬀ ⠀ ⠀ 瀀攀爀倀愀最攀 ⴀ ㄀ ⤀ ⨀ ⠀ 瀀愀最攀 ⴀ ㄀ ⤀ ⤀ ⬀ ✀⤀✀Ⰰ 瀀吀⤀⸀愀搀搀䌀氀愀猀猀⠀✀栀椀搀攀吀刀✀⤀㬀ഀഀ
						// back to the first page਍ऀऀऀऀऀऀ␀⠀✀⸀瀀愀最攀匀攀氀攀挀琀漀爀㨀昀椀爀猀琀✀Ⰰ 瀀吀⤀⸀挀氀椀挀欀⠀⤀㬀ഀഀ
						$(this).siblings('.perPageSelected').removeClass('perPageSelected');਍ऀऀऀऀऀऀ␀⠀琀栀椀猀⤀⸀愀搀搀䌀氀愀猀猀⠀✀瀀攀爀倀愀最攀匀攀氀攀挀琀攀搀✀⤀㬀ഀഀ
						// redraw the pagination਍ऀऀऀऀऀऀ搀爀愀眀倀愀最攀匀攀氀攀挀琀漀爀猀⠀ 瀀吀Ⰰ ㄀ ⤀㬀ഀഀ
						// update status bar਍ऀऀऀऀऀऀ瘀愀爀 挀倀漀猀 㴀 ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀渀漀琀⠀⸀栀椀搀攀吀刀⤀㨀昀椀爀猀琀✀Ⰰ 瀀吀⤀⸀瀀爀攀瘀䄀氀氀⠀⤀⸀氀攀渀最琀栀Ⰰഀഀ
							ePos = $('>tbody>tr:not(.hideTR):not(.stubCell)', pT).length;਍ऀऀऀऀऀऀ␀⠀✀㸀⸀渀愀瘀 ⸀猀琀愀琀甀猀✀Ⰰ 瀀吀⤀⸀栀琀洀氀⠀ ✀匀栀漀眀椀渀最 ✀ ⬀ ⠀ 挀倀漀猀 ⬀ ㄀ ⤀ ⬀ ✀ ⴀ ✀ ⬀ ⠀ 挀倀漀猀 ⬀ 攀倀漀猀 ⤀ ⬀ ✀ 漀昀 ✀ ⬀ 爀漀眀䌀漀甀渀琀 ⬀ ✀✀ ⤀㬀ഀഀ
						clearSelection();਍ऀऀऀऀऀऀ⼀⼀ 挀愀氀氀戀愀挀欀 昀甀渀挀琀椀漀渀 愀昀琀攀爀 瀀愀最椀渀愀琀椀漀渀 爀攀渀搀攀爀搀ഀഀ
						$(pT).data('tableSettings').clickCallback();਍ऀऀऀऀऀ紀ഀഀ
				);਍ऀऀऀ紀ഀഀ
		);਍ऀऀഀഀ
		// show the correct paging status਍ऀऀ瘀愀爀 挀倀漀猀 㴀 ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀渀漀琀⠀⸀栀椀搀攀吀刀⤀㨀昀椀爀猀琀✀Ⰰ 琀栀椀猀⤀⸀瀀爀攀瘀䄀氀氀⠀⤀⸀氀攀渀最琀栀Ⰰ ഀഀ
			ePos = $('>tbody>tr:not(.hideTR):not(.stubCell)', this).length;਍ऀऀ␀⠀✀㸀⸀渀愀瘀 ⸀猀琀愀琀甀猀✀Ⰰ 琀栀椀猀⤀⸀栀琀洀氀⠀ ✀猀栀漀眀椀渀最 ✀ ⬀ ⠀ 挀倀漀猀 ⬀ ㄀ ⤀ ⬀ ✀ ⴀ ✀ ⬀ ⠀ 挀倀漀猀 ⬀ 攀倀漀猀 ⤀ ⬀ ✀ 漀昀 ✀ ⬀ 爀漀眀䌀漀甀渀琀 ⤀㬀ഀഀ
਍ऀऀ⼀⼀ 挀氀攀愀爀 猀攀氀攀挀琀攀搀 琀攀砀琀 昀甀渀挀琀椀漀渀ഀഀ
		function clearSelection () {਍ऀऀऀ椀昀 ⠀ 搀漀挀甀洀攀渀琀⸀猀攀氀攀挀琀椀漀渀 ☀☀ 琀礀瀀攀漀昀⠀搀漀挀甀洀攀渀琀⸀猀攀氀攀挀琀椀漀渀⸀攀洀瀀琀礀⤀ ℀㴀 ✀甀渀搀攀昀椀渀攀搀✀ ⤀ഀഀ
				document.selection.empty();਍ऀऀऀ攀氀猀攀 椀昀 ⠀ 琀礀瀀攀漀昀⠀眀椀渀搀漀眀⸀最攀琀匀攀氀攀挀琀椀漀渀⤀ 㴀㴀㴀 ✀昀甀渀挀琀椀漀渀✀ ☀☀ 琀礀瀀攀漀昀⠀眀椀渀搀漀眀⸀最攀琀匀攀氀攀挀琀椀漀渀⠀⤀⸀爀攀洀漀瘀攀䄀氀氀刀愀渀最攀猀⤀ 㴀㴀㴀 ✀昀甀渀挀琀椀漀渀✀ ⤀ഀഀ
				window.getSelection().removeAllRanges();਍ऀऀ紀ഀഀ
਍ऀऀ⼀⼀ 爀攀渀搀攀爀 琀栀攀 瀀愀最椀渀愀琀椀漀渀 昀甀渀挀琀椀漀渀愀氀椀琀礀ഀഀ
		function drawPageSelectors ( target, page ) {਍ഀഀ
			// add pagination links਍ऀऀऀ␀⠀✀㸀⸀渀愀瘀 ⸀瀀愀最椀渀愀琀椀漀渀✀Ⰰ 琀愀爀最攀琀⤀⸀攀洀瀀琀礀⠀⤀㬀ഀഀ
			var pages = ( perPage >= rowCount || perPage == 0 ) ? 0 : Math.ceil( rowCount / perPage ), totalPages = pages;਍ऀऀऀ眀栀椀氀攀 ⠀ 瀀愀最攀猀ⴀⴀ ⤀ഀഀ
				$('>.nav .pagination', target).prepend( '<div class="pageSelector">' + ( pages + 1 ) + '</div>' );਍ऀऀऀ瘀愀爀 瀀愀最攀䌀漀甀渀琀 㴀 ␀⠀✀㸀⸀渀愀瘀㨀昀椀爀猀琀 ⸀瀀愀最攀匀攀氀攀挀琀漀爀✀Ⰰ 琀愀爀最攀琀⤀⸀氀攀渀最琀栀㬀ഀഀ
			$('>.nav', target).each(function () {਍ऀऀऀऀ␀⠀✀⸀栀椀搀攀倀愀最攀匀攀氀攀挀琀漀爀✀Ⰰ 琀栀椀猀⤀⸀爀攀洀漀瘀攀䌀氀愀猀猀⠀✀栀椀搀攀倀愀最攀匀攀氀攀挀琀漀爀✀⤀㬀ഀഀ
				$('.hilightPageSelector', this).removeClass('hilightPageSelector');਍ऀऀऀऀ␀⠀✀⸀瀀愀最攀匀攀氀攀挀琀漀爀匀攀瀀攀爀愀琀漀爀✀Ⰰ 琀栀椀猀⤀⸀爀攀洀漀瘀攀⠀⤀㬀ഀഀ
				$('.pageSelector:lt(' + ( ( page > ( pageCount - 4 ) ) ? ( pageCount - 5 ) : ( page - 2 ) ) + '):not(:first)', this).addClass('hidePageSelector')਍ऀऀऀऀऀ⸀攀焀⠀　⤀⸀愀昀琀攀爀⠀ ✀㰀搀椀瘀 挀氀愀猀猀㴀∀瀀愀最攀匀攀氀攀挀琀漀爀匀攀瀀攀爀愀琀漀爀∀㸀✀ ⬀ ␀⠀琀愀爀最攀琀⤀⸀搀愀琀愀⠀✀琀愀戀氀攀匀攀琀琀椀渀最猀✀⤀⸀瀀攀爀倀愀最攀匀攀瀀攀爀愀琀漀爀 ⬀ ✀㰀⼀搀椀瘀㸀✀ ⤀㬀ഀഀ
				$('.pageSelector:gt(' + ( ( page < 4 ) ? 4 : page ) + '):not(:last)', this).addClass('hidePageSelector')਍ऀऀऀऀऀ⸀攀焀⠀　⤀⸀愀昀琀攀爀⠀ ✀㰀搀椀瘀 挀氀愀猀猀㴀∀瀀愀最攀匀攀氀攀挀琀漀爀匀攀瀀攀爀愀琀漀爀∀㸀✀ ⬀ ␀⠀琀愀爀最攀琀⤀⸀搀愀琀愀⠀✀琀愀戀氀攀匀攀琀琀椀渀最猀✀⤀⸀瀀攀爀倀愀最攀匀攀瀀攀爀愀琀漀爀 ⬀ ✀㰀⼀搀椀瘀㸀✀ ⤀㬀ഀഀ
				$('.pageSelector:eq(' + ( page - 1 ) + ')', this).addClass('hilightPageSelector');਍ऀऀऀ紀⤀㬀ഀഀ
਍ऀऀऀ⼀⼀ 爀攀洀漀瘀攀 琀栀攀 瀀愀最攀爀 琀椀琀氀攀 椀昀 渀漀 瀀愀最攀猀 渀攀挀攀猀猀愀爀礀ഀഀ
			if ( perPage >= rowCount )਍ऀऀऀऀ␀⠀✀㸀⸀渀愀瘀 ⸀瀀愀最椀渀愀琀椀漀渀吀椀琀氀攀✀Ⰰ 琀愀爀最攀琀⤀⸀挀猀猀⠀✀搀椀猀瀀氀愀礀✀Ⰰ✀渀漀渀攀✀⤀㬀ഀഀ
			else਍ऀऀऀऀ␀⠀✀㸀⸀渀愀瘀 ⸀瀀愀最椀渀愀琀椀漀渀吀椀琀氀攀✀Ⰰ 琀愀爀最攀琀⤀⸀挀猀猀⠀✀搀椀猀瀀氀愀礀✀Ⰰ✀✀⤀㬀ഀഀ
			਍ऀऀऀ⼀⼀ 戀椀渀搀 琀栀攀 瀀愀最椀渀愀琀椀漀渀 漀渀挀氀椀挀欀ഀഀ
			$('>.nav .pagination .pageSelector', target).each(਍ऀऀऀऀ昀甀渀挀琀椀漀渀 ⠀⤀ 笀ഀഀ
					$(this).bind('click',਍ऀऀऀऀऀऀ昀甀渀挀琀椀漀渀 ⠀⤀ 笀ഀഀ
਍ऀऀऀऀऀऀऀ⼀⼀ 椀昀 搀漀甀戀氀攀 挀氀椀挀欀攀搀 ⴀ 猀琀漀瀀 愀渀椀洀愀琀椀漀渀 愀渀搀 樀甀洀瀀 琀漀 猀攀氀攀挀琀攀搀 瀀愀最攀 ⴀ 琀栀椀猀 愀瀀瀀攀愀爀猀 琀漀 戀攀 愀 琀爀椀瀀瀀氀攀 挀氀椀挀欀 椀渀 䤀䔀㜀ഀഀ
							if ( $(this).hasClass('hilightPageSelector') ) {਍ऀऀऀऀऀऀऀऀ椀昀 ⠀ ␀⠀琀栀椀猀⤀⸀瀀愀爀攀渀琀⠀⤀⸀焀甀攀甀攀⠀⤀⸀氀攀渀最琀栀 㸀 　 ⤀ 笀ഀഀ
									// really stop all animations and create new queue਍ऀऀऀऀऀऀऀऀऀ␀⠀琀栀椀猀⤀⸀瀀愀爀攀渀琀⠀⤀⸀猀琀漀瀀⠀⤀⸀焀甀攀甀攀⠀ ∀昀砀∀Ⰰ 嬀崀 ⤀⸀猀琀漀瀀⠀⤀㬀ഀഀ
									// set the user directly on the correct page without animation਍ऀऀऀऀऀऀऀऀऀ瘀愀爀 戀攀最椀渀倀漀猀 㴀 ⠀ ⠀ 瀀愀爀猀攀䤀渀琀⠀ ␀⠀琀栀椀猀⤀⸀栀琀洀氀⠀⤀ ⤀ ⴀ ㄀ ⤀ ⨀ 瀀攀爀倀愀最攀 ⤀Ⰰ 攀渀搀倀漀猀 㴀 戀攀最椀渀倀漀猀 ⬀ 瀀攀爀倀愀最攀㬀ഀഀ
									$('>tbody> tr', pT).removeClass('hideTR').addClass('hideTR');਍ऀऀऀऀऀऀऀऀऀ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀最琀⠀✀ ⬀ ⠀戀攀最椀渀倀漀猀 ⴀ ㈀⤀ ⬀ ✀⤀㨀氀琀⠀✀ ⬀ ⠀ 瀀攀爀倀愀最攀 ⤀ ⬀ ✀⤀✀Ⰰ 瀀吀⤀⸀愀渀搀匀攀氀昀⠀⤀⸀爀攀洀漀瘀攀䌀氀愀猀猀⠀✀栀椀搀攀吀刀✀⤀㬀ഀഀ
									// update status bar਍ऀऀऀऀऀऀऀऀऀ瘀愀爀 挀倀漀猀 㴀 ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀渀漀琀⠀⸀栀椀搀攀吀刀⤀㨀昀椀爀猀琀✀Ⰰ 瀀吀⤀⸀瀀爀攀瘀䄀氀氀⠀⤀⸀氀攀渀最琀栀Ⰰഀഀ
										ePos = $('>tbody>tr:not(.hideTR):not(.stubCell)', pT).length;਍ऀऀऀऀऀऀऀऀऀ␀⠀✀㸀⸀渀愀瘀 ⸀猀琀愀琀甀猀✀Ⰰ 瀀吀⤀⸀栀琀洀氀⠀ ✀匀栀漀眀椀渀最 ✀ ⬀ ⠀ 挀倀漀猀 ⬀ ㄀ ⤀ ⬀ ✀ ⴀ ✀ ⬀ ⠀ 挀倀漀猀 ⬀ 攀倀漀猀 ⤀ ⬀ ✀ 漀昀 ✀ ⬀ 爀漀眀䌀漀甀渀琀 ⬀ ✀✀ ⤀㬀ഀഀ
								}਍ऀऀऀऀऀऀऀऀ挀氀攀愀爀匀攀氀攀挀琀椀漀渀⠀⤀㬀ഀഀ
								return false;਍ऀऀऀऀऀऀऀ紀ഀഀ
਍ऀऀऀऀऀऀऀ⼀⼀ 栀椀氀椀最栀琀 琀栀攀 猀瀀攀挀椀昀椀挀 瀀愀最攀 戀甀琀琀漀渀ഀഀ
							$(this).addClass('hilightPageSelector');਍ഀഀ
							// really stop all animations਍ऀऀऀऀऀऀऀ␀⠀琀栀椀猀⤀⸀瀀愀爀攀渀琀⠀⤀⸀猀琀漀瀀⠀⤀⸀焀甀攀甀攀⠀ ∀昀砀∀Ⰰ 嬀崀 ⤀⸀猀琀漀瀀⠀⤀⸀搀攀焀甀攀甀攀⠀⤀㬀ഀഀ
਍ऀऀऀऀऀऀऀ⼀⼀ 猀攀琀甀瀀 琀栀攀 瀀愀最椀渀愀琀椀漀渀 瘀愀爀椀愀戀氀攀猀ഀഀ
							var beginPos = $('>tbody>tr:not(.hideTR):first', pT).prevAll().length,਍ऀऀऀऀऀऀऀऀ攀渀搀倀漀猀 㴀 ⠀ ⠀ 瀀愀爀猀攀䤀渀琀⠀ ␀⠀琀栀椀猀⤀⸀栀琀洀氀⠀⤀ ⤀ ⴀ ㄀ ⤀ ⨀ 瀀攀爀倀愀最攀 ⤀㬀ഀഀ
							if ( endPos > rowCount )਍ऀऀऀऀऀऀऀऀ攀渀搀倀漀猀 㴀 ⠀爀漀眀䌀漀甀渀琀 ⴀ ㄀⤀㬀ഀഀ
							// set the steps to be exponential for all the page scroll difference - i.e. faster for more pages to scroll਍ऀऀऀऀऀऀऀ瘀愀爀 猀匀琀攀瀀 㴀 ␀⠀瀀吀⤀⸀搀愀琀愀⠀✀琀愀戀氀攀匀攀琀琀椀渀最猀✀⤀⸀猀挀爀漀氀氀匀琀攀瀀 ⨀ 䴀愀琀栀⸀挀攀椀氀⠀ 䴀愀琀栀⸀愀戀猀⠀ ⠀ 攀渀搀倀漀猀 ⴀ 戀攀最椀渀倀漀猀 ⤀ ⼀ 瀀攀爀倀愀最攀 ⤀ ⤀㬀ഀഀ
							if ( sStep > perPage ) sStep = perPage;਍ऀऀऀऀऀऀऀ瘀愀爀 猀琀攀瀀猀 㴀 䴀愀琀栀⸀挀攀椀氀⠀ 䴀愀琀栀⸀愀戀猀⠀ 戀攀最椀渀倀漀猀 ⴀ 攀渀搀倀漀猀 ⤀ ⼀ 猀匀琀攀瀀 ⤀㬀ഀഀ
਍ऀऀऀऀऀऀऀ⼀⼀ 猀琀愀爀琀 猀挀爀漀氀氀椀渀最ഀഀ
							while ( steps-- ) {਍ऀऀऀऀऀऀऀऀ␀⠀琀栀椀猀⤀⸀瀀愀爀攀渀琀⠀⤀⸀愀渀椀洀愀琀攀⠀笀✀漀瀀愀挀椀琀礀✀㨀㄀紀Ⰰ ␀⠀瀀吀⤀⸀搀愀琀愀⠀✀琀愀戀氀攀匀攀琀琀椀渀最猀✀⤀⸀猀挀爀漀氀氀䐀攀氀愀礀Ⰰഀഀ
									function () {਍ऀऀऀऀऀऀऀऀऀऀ⼀⼀ 爀攀猀攀琀 琀栀攀 猀挀爀漀氀氀匀琀攀瀀 昀漀爀 琀栀攀 爀攀洀愀椀渀椀渀最 椀琀攀洀猀ഀഀ
										if ( $(this).queue("fx").length == 0 )਍ऀऀऀऀऀऀऀऀऀऀऀ猀匀琀攀瀀 㴀 ⠀ 䴀愀琀栀⸀愀戀猀⠀ 戀攀最椀渀倀漀猀 ⴀ 攀渀搀倀漀猀 ⤀ ─ 猀匀琀攀瀀 ⤀ 簀簀 猀匀琀攀瀀㬀ഀഀ
										/* scoll up */਍ऀऀऀऀऀऀऀऀऀऀ椀昀 ⠀ 戀攀最椀渀倀漀猀 㸀 攀渀搀倀漀猀 ⤀ 笀ഀഀ
											$('>tbody>tr:not(.hideTR):first', pT).prevAll(':lt(' + sStep + ')').removeClass('hideTR');਍ऀऀऀऀऀऀऀऀऀऀऀ椀昀 ⠀ ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀渀漀琀⠀⸀栀椀搀攀吀刀⤀✀Ⰰ 瀀吀⤀⸀氀攀渀最琀栀 㸀 瀀攀爀倀愀最攀 ⤀ഀഀ
												$('>tbody>tr:not(.hideTR):last', pT).prevAll(':lt(' + ( sStep - 1 ) + ')').andSelf().addClass('hideTR');਍ऀऀऀऀऀऀऀऀऀऀऀ⼀⼀ 椀昀 猀挀爀漀氀氀椀渀最 甀瀀 昀爀漀洀 氀攀猀猀 爀漀眀猀 琀栀愀渀 瀀攀爀倀愀最攀 ⴀ 挀漀洀瀀攀渀猀愀琀攀 椀昀 㰀 瀀攀爀倀愀最攀ഀഀ
											var currRows =  $('>tbody>tr:not(.hideTR)', pT).length;਍ऀऀऀऀऀऀऀऀऀऀऀ椀昀 ⠀ 挀甀爀爀刀漀眀猀 㰀 瀀攀爀倀愀最攀 ⤀ഀഀ
												$('>tbody>tr:not(.hideTR):last', pT).nextAll(':lt(' + ( perPage - currRows ) + ')').removeClass('hideTR');਍ऀऀऀऀऀऀऀऀऀऀ⼀⨀ 猀挀爀漀氀氀 搀漀眀渀 ⨀⼀ഀഀ
										} else {਍ऀऀऀऀऀऀऀऀऀऀऀ瘀愀爀 攀渀搀倀漀椀渀琀 㴀 ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀渀漀琀⠀⸀栀椀搀攀吀刀⤀㨀氀愀猀琀✀Ⰰ 瀀吀⤀㬀ഀഀ
											$('>tbody>tr:not(.hideTR):lt(' + sStep + ')', pT).addClass('hideTR');਍ऀऀऀऀऀऀऀऀऀऀऀ␀⠀攀渀搀倀漀椀渀琀⤀⸀渀攀砀琀䄀氀氀⠀✀㨀氀琀⠀✀ ⬀ 猀匀琀攀瀀 ⬀ ✀⤀✀⤀⸀爀攀洀漀瘀攀䌀氀愀猀猀⠀✀栀椀搀攀吀刀✀⤀㬀ഀഀ
										}਍ऀऀऀऀऀऀऀऀऀऀ⼀⼀ 甀瀀搀愀琀攀 猀琀愀琀甀猀 戀愀爀ഀഀ
										var cPos = $('>tbody>tr:not(.hideTR):first', pT).prevAll().length,਍ऀऀऀऀऀऀऀऀऀऀऀ攀倀漀猀 㴀 ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀渀漀琀⠀⸀栀椀搀攀吀刀⤀㨀渀漀琀⠀⸀猀琀甀戀䌀攀氀氀⤀✀Ⰰ 瀀吀⤀⸀氀攀渀最琀栀㬀ഀഀ
										$('>.nav .status', pT).html( 'Showing ' + ( cPos + 1 ) + ' - ' + ( cPos + ePos ) + ' of ' + rowCount + '' );਍ऀऀऀऀऀऀऀऀऀ紀ഀഀ
								);਍ऀऀऀऀऀऀऀ紀ഀഀ
							਍ऀऀऀऀऀऀऀ⼀⼀ 爀攀搀爀愀眀 琀栀攀 瀀愀最椀渀愀琀椀漀渀ഀഀ
							drawPageSelectors( pT, parseInt( $(this).html() ) );਍ऀऀऀऀऀऀऀഀഀ
							// callback function after pagination renderd਍ऀऀऀऀऀऀऀ␀⠀瀀吀⤀⸀搀愀琀愀⠀✀琀愀戀氀攀匀攀琀琀椀渀最猀✀⤀⸀挀氀椀挀欀䌀愀氀氀戀愀挀欀⠀⤀㬀ഀഀ
							਍ऀऀऀऀऀऀ紀ഀഀ
					);਍ऀऀऀऀ紀ഀഀ
			);਍ऀऀऀഀഀ
		};਍ऀऀ⼀⼀ 猀漀爀琀 眀爀愀瀀瀀攀爀 昀甀渀挀琀椀漀渀ഀഀ
		function sort ( target, tdIndex, desc ) {਍ऀऀऀ瘀愀爀 昀䌀漀氀 㴀 ␀⠀✀㸀琀栀攀愀搀 琀栀Ⰰ㸀琀栀攀愀搀 琀栀✀Ⰰ 琀愀爀最攀琀⤀⸀最攀琀⠀琀搀䤀渀搀攀砀⤀Ⰰഀഀ
				sorted = $(fCol).hasClass('sortAsc') || $(fCol).hasClass('sortDesc') || false,਍ऀऀऀऀ渀甀氀氀䌀栀愀爀 㴀 匀琀爀椀渀最⸀昀爀漀洀䌀栀愀爀䌀漀搀攀⠀　⤀Ⰰ ഀഀ
				re = /([-]?[0-9\.]+)/g,਍ऀऀऀऀ爀漀眀猀 㴀 ␀⠀✀㸀琀戀漀搀礀㸀琀爀㨀渀漀琀⠀⸀猀琀甀戀䌀攀氀氀⤀✀Ⰰ 琀愀爀最攀琀⤀⸀最攀琀⠀⤀Ⰰ ഀഀ
				procRow = [];਍ഀഀ
			$(rows).each(਍ऀऀऀऀ昀甀渀挀琀椀漀渀⠀欀攀礀Ⰰ 瘀愀氀⤀ 笀ഀഀ
					procRow.push( $('>td:eq(' + tdIndex + ')', val).text() + nullChar + procRow.length );਍ऀऀऀऀ紀ഀഀ
			);਍ऀऀऀ椀昀 ⠀ ℀猀漀爀琀攀搀 ⤀ 笀ഀഀ
				// natural sort਍ऀऀऀऀ瀀爀漀挀刀漀眀⸀猀漀爀琀⠀ഀഀ
					function naturalSort (a, b) {਍ऀऀऀऀऀऀ⼀⼀ 猀攀琀甀瀀 琀攀洀瀀ⴀ猀挀漀瀀攀 瘀愀爀椀愀戀氀攀猀 昀漀爀 挀漀洀瀀愀爀椀猀漀渀 攀瘀愀甀氀甀愀琀椀漀渀ഀഀ
						var re = /(-?[0-9\.]+)/g,਍ऀऀऀऀऀऀऀ渀䌀 㴀 匀琀爀椀渀最⸀昀爀漀洀䌀栀愀爀䌀漀搀攀⠀　⤀Ⰰഀഀ
							x = a.toString().toLowerCase().split(nC)[0] || '',਍ऀऀऀऀऀऀऀ礀 㴀 戀⸀琀漀匀琀爀椀渀最⠀⤀⸀琀漀䰀漀眀攀爀䌀愀猀攀⠀⤀⸀猀瀀氀椀琀⠀渀䌀⤀嬀　崀 簀簀 ✀✀Ⰰഀഀ
							xN = x.replace( re, nC + '$1' + nC ).split(nC),਍ऀऀऀऀऀऀऀ礀一 㴀 礀⸀爀攀瀀氀愀挀攀⠀ 爀攀Ⰰ 渀䌀 ⬀ ✀␀㄀✀ ⬀ 渀䌀 ⤀⸀猀瀀氀椀琀⠀渀䌀⤀Ⰰഀഀ
							xD = (new Date(x)).getTime(),਍ऀऀऀऀऀऀऀ礀䐀 㴀 砀䐀 㼀 ⠀渀攀眀 䐀愀琀攀⠀礀⤀⤀⸀最攀琀吀椀洀攀⠀⤀ 㨀 渀甀氀氀㬀ഀഀ
						// natural sorting of dates਍ऀऀऀऀऀऀ椀昀 ⠀ 礀䐀 ⤀ഀഀ
							if ( xD < yD ) return -1;਍ऀऀऀऀऀऀऀ攀氀猀攀 椀昀 ⠀ 砀䐀 㸀 礀䐀 ⤀ऀ爀攀琀甀爀渀 ㄀㬀ഀഀ
						// natural sorting through split numeric strings and default strings਍ऀऀऀऀऀऀ昀漀爀⠀ 瘀愀爀 挀䰀漀挀 㴀 　Ⰰ 渀甀洀匀 㴀 䴀愀琀栀⸀洀愀砀⠀砀一⸀氀攀渀最琀栀Ⰰ 礀一⸀氀攀渀最琀栀⤀㬀 挀䰀漀挀 㰀 渀甀洀匀㬀 挀䰀漀挀⬀⬀ ⤀ 笀ഀഀ
							oFxNcL = parseFloat(xN[cLoc]) || xN[cLoc];਍ऀऀऀऀऀऀऀ漀䘀礀一挀䰀 㴀 瀀愀爀猀攀䘀氀漀愀琀⠀礀一嬀挀䰀漀挀崀⤀ 簀簀 礀一嬀挀䰀漀挀崀㬀ഀഀ
							if (oFxNcL < oFyNcL) return -1;਍ऀऀऀऀऀऀऀ攀氀猀攀 椀昀 ⠀漀䘀砀一挀䰀 㸀 漀䘀礀一挀䰀⤀ 爀攀琀甀爀渀 ㄀㬀ഀഀ
						}਍ऀऀऀऀऀऀ爀攀琀甀爀渀 　㬀ഀഀ
					});਍ऀऀऀऀ椀昀 ⠀ ℀搀攀猀挀 ⤀ 瀀爀漀挀刀漀眀⸀爀攀瘀攀爀猀攀⠀⤀㬀 ⼀⼀ 瀀爀漀瀀攀爀氀礀 瀀漀猀椀琀椀漀渀 漀爀搀攀爀 漀昀 猀漀爀琀ഀഀ
			}਍ऀऀऀ⼀⼀ 渀漀眀 爀攀ⴀ漀爀搀攀爀 琀栀攀 瀀愀爀攀渀琀 琀戀漀搀礀 戀愀猀攀搀 漀昀昀 琀栀攀 焀甀椀挀欀 猀漀爀琀攀搀 琀戀漀搀礀 洀愀瀀ഀഀ
			$('>tbody', target).addClass('jtpstemp').before('<tbody></tbody>');਍ऀऀऀ瘀愀爀 渀爀 㴀 瀀爀漀挀刀漀眀⸀氀攀渀最琀栀Ⰰ 琀昀 㴀 ␀⠀✀㸀琀戀漀搀礀✀Ⰰ 琀愀爀最攀琀⤀嬀　崀㬀ഀഀ
			// move the row from old tbody to new tbody in order of new tbody with replaceWith to retain original tbody row positioning਍ऀऀऀ椀昀 ⠀ 猀漀爀琀攀搀 ⤀ഀഀ
				while ( nr-- )਍ऀऀऀऀऀ琀昀⸀愀瀀瀀攀渀搀䌀栀椀氀搀⠀ 爀漀眀猀嬀 渀爀 崀 ⤀㬀ഀഀ
			else਍ऀऀऀऀ眀栀椀氀攀 ⠀ 渀爀ⴀⴀ ⤀ഀഀ
					tf.appendChild( rows[ parseInt( procRow[ nr ].split(nullChar).pop() ) ] );਍ऀऀऀ⼀⼀ 爀攀洀漀瘀攀 琀栀攀 漀氀搀 琀愀戀氀攀ഀഀ
			$('>tbody.jtpstemp', target).remove();਍ऀऀऀ⼀⼀ 爀攀搀爀愀眀 猀琀甀戀 爀漀眀猀ഀഀ
			var stubCount=0, cols = $('>thead>tr:last th', target).length, ਍ऀऀऀऀ猀琀甀戀猀 㴀 ⠀ 瀀攀爀倀愀最攀 ⴀ ⠀ ␀⠀✀㸀琀戀漀搀礀㸀琀爀✀Ⰰ 琀愀爀最攀琀⤀⸀氀攀渀最琀栀 ─ 瀀攀爀倀愀最攀 ⤀ ⤀Ⰰ ഀഀ
				stubHeight = $('>tbody>tr:first>td:first', target).css('height');਍ऀऀऀ昀漀爀 ⠀ 㬀 猀琀甀戀䌀漀甀渀琀 㰀 猀琀甀戀猀 ☀☀ 猀琀甀戀猀 ℀㴀 瀀攀爀倀愀最攀㬀 猀琀甀戀䌀漀甀渀琀⬀⬀ ⤀ഀഀ
				$('>tbody>tr:last', target).after( '<tr class="stubCell"><td colspan="' + cols + '" style="height: ' + stubHeight + ';">&nbsp;</td></tr>' );਍ऀऀ紀ഀഀ
		// chainable਍ऀऀ爀攀琀甀爀渀 琀栀椀猀㬀ഀഀ
	};਍ഀഀ
})(jQuery);