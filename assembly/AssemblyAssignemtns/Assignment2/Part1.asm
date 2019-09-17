; Assignment 2 - part 1
.386
.model flat, stdcall
.stack 4096
ExitProcess proto, dwExitCode:dword

.data
one WORD 8002h
two WORD 4321h

.code
main proc
mov dx, 21348041h
movsx edx, one 
movsx edx, two

invoke ExitProcess, 0
main endp
end main