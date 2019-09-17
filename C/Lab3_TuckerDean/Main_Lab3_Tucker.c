#include "lab3.h"

int main(void) {
	char* dataPtrTemp;
	char LU[]= "Lakehead University";

	QUEUE* queue = createQueue();

	for (int i = 0; LU[i] != 0; i++) {
	enqueue(queue, &LU[i]);
	}

	printf("queue count = ");
	printf("%d\n", queueCount(queue));

	printf("Inputed String = ");
	while (!emptyQueue(queue)) {
		dequeue(queue, (void**)&dataPtrTemp);
		printf("%c", *dataPtrTemp);
	}

	if (queueCount(queue) == 0)
		destroyQueue(queue);
	
	puts(" ");
	system("pause");
}



