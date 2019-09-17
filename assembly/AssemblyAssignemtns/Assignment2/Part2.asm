; Assignment 2 - part 2
.386
.model flat, stdcall
.stack 4096
ExitProcess proto, dwExitCode:dword

.data
dVal DWORD ?
.code
; main proc
mov	dVal, 12345678h
mov ax, WORD PTR dVal + 2
add ax, 3
mov WORD PTR dVal, ax
mov eax, dVal

invoke ExitProcess, 0
; main endp
end main