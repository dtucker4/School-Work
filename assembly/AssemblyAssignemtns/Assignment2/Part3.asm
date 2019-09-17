; Assignment 2 - part 3
.386
.model flat, stdcall
.stack 4096
ExitProcess proto, dwExitCode:dword

.data
myBytes BYTE 10h, 20h, 30h, 40h
myWords WORD 3 dup(? ), 2000h
myString BYTE "ABCDE"


.code
; main proc


invoke ExitProcess, 0
; main endp
end main