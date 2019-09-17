;asm assignment 6
;Dean Tucker
;March 17th 2017

INCLUDE Irvine32.inc
.386
.model flat, stdcall
.stack 4096
ExitProcess proto, dwExitCode:dword
GCDProc PROTO, val1 : DWORD, val2 : DWORD

	.data
	array DWORD -30, -18
	str1 BYTE "GCD = ", 0

	.code
	main PROC

	mov  ecx, LENGTHOF array / 2
	mov  esi, OFFSET array

	L1:	INVOKE GCDProc, [esi], [esi + 4]
	mov  edx, OFFSET str1
	call WriteString
	call WriteDec
	call Crlf
	add  esi, TYPE array * 2
	loop L1

	exit
	main ENDP

	GCDProc PROC,val1:DWORD, val2 : DWORD

	mov  eax, val1
	mov  ebx, val2
	
	cmp eax, 0
	jg GT01
	xor eax, 0ffffffffh
	inc eax

	GT01:
	cmp ebx, 0
	jg GT02
	xor ebx, 0ffffffffh
	inc ebx
	GT02:
		mov  edx, 0
		div ebx
		cmp  edx, 0
		je   L2
		INVOKE GCDProc, ebx, edx

		L2 : mov eax, ebx
		ret
	GCDProc ENDP

END main